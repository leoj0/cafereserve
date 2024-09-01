<?php

namespace App\Http\Controllers;

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
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    // Show create form
    public function create(Request $request, Cafe $cafe)
    {

        // Retrieve the table ID from the request
        $tableId = $request->input('table_id');
        $table = Table::find($tableId);
    
        // Check if the table exists
        if (!$table) {
            return redirect()->back()->withErrors('Table not found');
        }
    
        // Retrieve other attributes from the request
        $reservationDate = $request->input('reservation_date');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $guestNumber = $request->input('guest_number');
        $specialRequest = $request->input('special_request');
    
        // Pass data to the view
        return view('reservations.create', [
            'cafe' => $cafe,
            'table' => $table,
            'reservation_date' => $reservationDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'guest_number' => $guestNumber,
            'special_request' => $specialRequest,
        ]);
    }
    

    // 
    public function store(Request $request, $cafe_id)
    {
        // Validate request
        $formFields = $request->validate([
            'cafe_id' => 'required|exists:cafes,cafe_id',
            'table_id' => 'required|exists:tables,table_id',
            'user_id' => 'required|exists:users,user_id',
            'reservation_date' => 'required|date|after:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'guest_number' => 'required|integer|min:1',
            'special_request' => 'nullable|string|max:500',
        ]);
    
        // Add cafe_id to form fields if needed
        $formFields['cafe_id'] = $cafe_id;
    
        // Attempt to create the reservation
        $reservation = Reservation::create($formFields);
    
        // Redirect with success message
        return redirect()->route('landing', ['cafe' => $cafe_id])
                         ->with('message', 'Reservation successfully created');
    }
    

    public function edit(Cafe $cafe, Reservation $reservation)
    {
        // Get available tables for the cafe
        $tables = $cafe->tables()->where('availability_status', 'available')->get();

        return view('reservations.edit', compact('cafe', 'reservation', 'tables'));
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.manage', ['cafe' => $reservation->cafe_id])->with('message', 'Reservation deleted successfully');
    }

    public function manage(Cafe $cafe)
    {
        // Retrieve all reservations associated with the cafe
        $reservations = $cafe->reservations;

        // Return the view with the cafe and reservation data
        return view('reservations.manage', compact('cafe', 'reservations'));
    }

    public function search(Request $request)
    {
        $filters = $request->only(['location', 'search']); // Adjust according to your input names
    
        $cafes = Cafe::latest()
                     ->filter($filters)
                     ->paginate(5); // Adjust pagination as needed
    
        return view('reservations.search', compact('cafes'));
    }


    public function selectTablesPage(Request $request, Cafe $cafe)
    {
        // Handle requests without input data
        if ($request->isMethod('get') && !$request->hasAny(['reservation_date', 'start_time', 'end_time'])) {
            return view('reservations.select-tables', ['cafe' => $cafe, 'tables' => collect()]);
        }
    
        // Validate the input data with custom error messages
        $validated = $request->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'end_time.after' => 'The end time must be a time after the start time.',
        ]);
    
        // Retrieve and filter tables based on the validated request parameters
        $tables = Table::where('cafe_id', $cafe->cafe_id)
                       ->filter($request->only(['reservation_date', 'start_time', 'end_time']))
                       ->get();
    
        return view('reservations.select-tables', [
            'cafe' => $cafe,
            'tables' => $tables,
        ]);
    }

}
