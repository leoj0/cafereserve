<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function create($cafe_id)
    {
        $cafe = Cafe::findOrFail($cafe_id);
        return view('tables.create', compact('cafe'));
    }

    public function store(Request $request, $cafe_id)
    {
        $formfields = $request->validate([
            'table_number' => 'required|string|max:255',
            'seating_capacity' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
            'availability_status' => 'required|string|in:Available,Reserved',
        ]);
    
        $formfields['cafe_id'] = $cafe_id;
    
        Table::create($formfields);
    
        return redirect()->route('tables.manage', ['cafe' => $cafe_id])->with('message', 'Table successfully created');
    }

    public function edit(Cafe $cafe, $table_id)
    {
        // Retrieve the table using the updated column name
        $table = Table::where('table_id', $table_id)
                      ->where('cafe_id', $cafe->cafe_id)
                      ->firstOrFail();
        
        return view('tables.edit', compact('cafe', 'table'));
    }


    public function update(Request $request, $cafe_id, $table_id)
    {
        // Validate the form data
        $formfields = $request->validate([
            'table_number' => 'required|string|max:255',
            'seating_capacity' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
            'availability_status' => 'required|in:Available,Reserved'
        ]);
    
        // Retrieve the table using the updated column name
        $table = Table::where('table_id', $table_id)
                      ->where('cafe_id', $cafe_id)
                      ->firstOrFail();
    
        // Update the table with validated data
        $table->update($formfields);
    
        // Redirect back with a success message
        return redirect()->route('tables.manage', ['cafe' => $cafe_id])
                         ->with('message', 'Table successfully updated');
    }
    

    public function destroy($cafe_id, Table $table)
    {
        $table->delete();

        return redirect()->route('tables.manage', ['cafe' => $cafe_id])->with('message', 'Table successfully deleted');
    }
    
    public function manage($cafe_id)
    {
        $cafe = Cafe::findOrFail($cafe_id);
        $tables = Table::where('cafe_id', $cafe_id)->get();
    
        return view('tables.manage', compact('cafe', 'tables'));
    }
}