<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cafe;
use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    // Show all reservation
    public function index(Cafe $cafe)
    {
        // Retrieve all reservations associated with the cafe
        $reservations = $cafe->reservations;

        // Return the view with the cafe and reservation data
        return view('reservations.index', compact('cafe', 'reservations'));
    }

    // Show single reservation
    public function show($reservation)
    {
        // Fetch the reservation along with user and table details
        $reservation = Reservation::with('user', 'table')->findOrFail($reservation);
    
        return view('reservations.show', compact('reservation'));
    }

    // Show create form
    public function create(Request $request, Cafe $cafe)
    {
        // Validate table_id from the request (if needed)
        $request->validate([
            'table_id' => 'required|exists:tables,table_id', // Ensure table_id is required and exists in tables
        ]);
    
        // Retrieve the table ID from the request
        $tableId = $request->input('table_id');
        $table = Table::find($tableId);
    
        // Check if the table exists
        if (!$table) {
            return redirect()->back()->withErrors('Table not found');
        }
    
        // Pass data to the view
        return view('reservations.create', [
            'cafe' => $cafe,
            'table' => $table,
            'reservation_date' => $request->input('reservation_date', ''),
            'start_time' => $request->input('start_time', ''),
            'end_time' => $request->input('end_time', ''),
            'guest_number' => $request->input('guest_number', ''),
            'special_request' => $request->input('special_request', ''),
        ]);
    }
    
    

    // 
    public function store(Request $request, $cafe_id)
    {
        // Fetch the table using the provided table_id
        $table = Table::where('table_id', $request->input('table_id'))->first();
    
        if (!$table) {
            return redirect()->back()->withErrors(['table_id' => 'Invalid table selected']);
        }
    
        // Validate the request with dynamic seating capacity
        $formFields = $request->validate([
            'cafe_id' => 'required|exists:cafes,cafe_id',
            'table_id' => 'required|exists:tables,table_id',
            'user_id' => 'required|exists:users,user_id',
            'reservation_date' => 'required|date|after:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'guest_number' => 'required|integer|min:1|max:' . $table->seating_capacity,
            'special_request' => 'nullable|string|max:500',
        ]);
    
        // Add cafe_id to form fields if needed
        $formFields['cafe_id'] = $cafe_id;
    
        // Attempt to create the reservation
        $reservation = Reservation::create($formFields);
    
        // Redirect with success message
        return redirect()->route('landing', ['cafe' => $cafe_id])
                         ->with('message', 'Reservation created successfully');
    }
    

    public function edit($id)
    {
        // Fetch the reservation and related details
        $reservation = Reservation::with(['cafe', 'table'])->findOrFail($id);
    
        // Check if the user has permission to edit this reservation
        if (auth()->id() !== $reservation->user_id) {
            return redirect()->route('reservations.index')->with('error', 'Unauthorized access.');
        }
    
        // Pass data to the view
        return view('reservations.edit', [
            'reservation' => $reservation,
            'cafe' => $reservation->cafe,
            'table' => $reservation->table,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
    
        // Retrieve the associated table
        $table = Table::findOrFail($reservation->table_id);
    
        $rules = [
            'guest_number' => 'required|integer|min:1|max:' . $table->seating_capacity,
            'special_request' => 'nullable|string',
        ];
    
        // Check if the reservation date was changed
        if ($request->has('reservation_date') && $request->reservation_date !== $reservation->reservation_date) {
            $rules['reservation_date'] = 'required|date';
        }
    
        // Check if the start time was changed
        if ($request->has('start_time') && $request->start_time !== $reservation->start_time) {
            $rules['start_time'] = 'required|date_format:H:i';
        }
    
        // Check if the end time was changed
        if ($request->has('end_time') && $request->end_time !== $reservation->end_time) {
            $rules['end_time'] = 'required|date_format:H:i';
        }
    
        // Validate the request with dynamic rules
        $request->validate($rules);
    
        // Update the reservation with the new data
        $reservation->update([
            'reservation_date' => $request->reservation_date ?? $reservation->reservation_date,
            'start_time' => $request->start_time ?? $reservation->start_time,
            'end_time' => $request->end_time ?? $reservation->end_time,
            'guest_number' => $request->guest_number,
            'special_request' => $request->special_request,
        ]);
    
        return redirect()->route('reservations.user')->with('message', 'Reservation updated successfully');
    }
    

    public function search(Request $request)
    {
        $filters = $request->only(['location', 'search']); // Adjust according to your input names
    
        $cafes = Cafe::latest()
                     ->filter($filters)
                     ->paginate(8); // Adjust pagination as needed
    
        return view('reservations.search', compact('cafes'));
    }


    public function selectTablesPage(Request $request, Cafe $cafe)
    {
        // Handle requests without input data
        if ($request->isMethod('get') && !$request->hasAny(['reservation_date', 'start_time', 'end_time'])) {
            return view('reservations.select-tables', [
                'cafe' => $cafe,
                'tables' => collect(),
                'reservation_date' => null,
                'start_time' => null,
                'end_time' => null,
            ]);
        }
        
        // Validate the input data with custom error messages
        $validated = $request->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'end_time.after' => 'The end time must be a time after the start time.',
            'reservation_date.after_or_equal' => 'The reservation date must be today or a future date.',
        ]);
        
        // Retrieve and filter tables based on the validated request parameters
        $tables = Table::where('cafe_id', $cafe->cafe_id)
                       ->filter($request->only(['reservation_date', 'start_time', 'end_time']))
                       ->get();
        
        return view('reservations.select-tables', [
            'cafe' => $cafe,
            'tables' => $tables,
            'reservation_date' => $request->input('reservation_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);
    }

    public function userReservations()
    {
        $user = auth()->user();
    
        if ($user) {
            // Get past and future reservations using model scopes
            $pastReservations = $user->reservations()->past()->with('cafe', 'table')->get();
            $futureReservations = $user->reservations()->future()->with('cafe', 'table')->get();
    
            // Pass both collections to the view
            return view('reservations.user-reservations', compact('pastReservations', 'futureReservations'));
        } else {
            return redirect()->route('login');
        }
    }
    


    public function manage(Request $request, Cafe $cafe)
    {
        $dateFilter = $request->input('reservation_date');
    
        // Fetch reservations with optional date filtering and paginate
        $reservations = Reservation::where('cafe_id', $cafe->cafe_id)
            ->with('user', 'table')
            ->when($dateFilter, function ($query, $dateFilter) {
                return $query->whereDate('reservation_date', $dateFilter);
            })
            ->orderBy('reservation_date', 'asc')
            ->paginate(10); // Adjust the number of items per page as needed
    
        return view('reservations.manage', compact('cafe', 'reservations', 'dateFilter'));

    }

    public function showReservations()
    {
        $pastReservations = Reservation::past()->get();
        $futureReservations = Reservation::future()->get();

        return view('reservations.index', compact('pastReservations', 'futureReservations'));
    }

    public function destroy($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        
        // Optionally, check if the reservation is within a cancellable window
        if ($reservation->reservation_date >= Carbon::now()) {
            $reservation->delete();
            return redirect()->route('reservations.user')->with('message', 'Reservation cancelled successfully');
        }
        
        return back()->with('error', 'Cannot cancel past reservations');
    }


}
