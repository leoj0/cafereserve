<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function showPendingCafes(Request $request)
    {
        // Get the status and search input from the request
        $status = $request->input('status');
        $search = $request->input('search');
    
        // Start building the query
        $query = Cafe::query();
    
        // Apply status filter if selected
        if ($status) {
            $query->where('status', $status);
        }
    
        // Apply search filter if provided
        if ($search) {
            $query->where('cafe_name', 'like', '%' . $search . '%');
        }
    
        // Paginate the results
        $cafes = $query->paginate(5);
    
        // Pass the results and filters back to the view
        return view('admins.index', compact('cafes'));
    }
    

    public function updateCafeStatus(Request $request, $id)
    {
        $cafe = Cafe::findOrFail($id);
        $cafe->status = $request->status;

        $cafe->admin_comment = $request->input('admin_comment');

        $cafe->save();

        return redirect()->back()->with('message', 'Cafe status updated successfully!');
    }
}