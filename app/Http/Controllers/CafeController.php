<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CafeController extends Controller
{
    //show all cafe
    public function index()
    {
        return view('cafe_listings.index', [
            'cafes' => Cafe::latest()->filter(request(['tag','search']))->Paginate(5)
        ]);
    }

    //show single cafe
    public function show(Cafe $cafe)
    {
        return view('cafe_listings.show', [
            'cafe' => $cafe
        ]);
    }

    //show create form
    public function create()
    {
        return view('cafe_listings.create');
    }

    //edit cafe
    public function edit(Cafe $cafe)
    {
        return view('cafe_listings.edit', ['cafe'=>$cafe]);
    }

    //update cafe
    public function update(Request $request, Cafe $cafe)
    {
        // Validate the request data
        $formfields = $request->validate([
            'cafe_name' => ['required'],
            'phone_number' => 'required|string|max:15',
            'cafe_tags' => 'required|string',
            'location' => 'required',
            'email' => 'required|email|max:255',
            'website' => 'required|url|max:255',
            'description' => 'required|string',
            'opening_time' => 'required|string',
            'closing_time' => 'required|string'
        ]);
    
        // Handle the logo file upload if present
        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($cafe->logo) {
                Storage::disk('public')->delete($cafe->logo);
            }
            $formfields['logo'] = $request->file('logo')->store('logos', 'public');
        }
    
        // Update the existing cafe record with the validated data
        $cafe->update($formfields);
    
        return redirect('/cafe_listings/manage')->with('message', 'Cafe updated successfully');
    }
    
    //delete cafe
    public function destroy(Cafe $cafe)
    {
        // Check if the authenticated user is the owner of the cafe
        if ($cafe->user_id !== Auth::id()) {
            return redirect()->route('owners.index')->with('error', 'You do not have permission to delete this cafe.');
        }
    
        // Delete the cafe
        $cafe->delete();
    
        // Redirect to a list of cafes or any other appropriate page
        return redirect()->route('owners.index')->with('message', 'Cafe deleted successfully');
    }

    //store cafe
    public function store(Request $request)
    {
        $formfields = $request->validate([
            'cafe_name' => ['required', Rule::unique('cafes', 'cafe_name')],
            'phone_number' => 'required|string|max:15',
            'cafe_tags' => 'required|string',
            'location' => 'required',
            'email' => 'required|email|max:255',
            'website' => 'required|url|max:255',
            'description' => 'required|string',
            'opening_time' => 'required|string',
            'closing_time' => 'required|string'
        ]);

        if($request->hasFile('logo'))
        {
            $formfields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formfields['user_id'] = auth()->id();
        
        Cafe::create($formfields);

        return redirect('/')->with('message', 'Cafe request successfully sent for approval');
    }

    public function manage(Cafe $cafe)
    {
        $userId = Auth::id(); // Get the authenticated user's ID
    
        // Check if the cafe belongs to the authenticated user
        if ($cafe->user_id !== $userId) {
            // Redirect to a page showing an error or a list of cafes
            return redirect()->route('owners.index')->with('error', 'You do not have permission to view this cafe.');
        }
    
        // If the cafe is found and belongs to the user, return the view
        return view('cafe_listings.manage', [
            'cafe' => $cafe
        ]);
    }


}
