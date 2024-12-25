<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function showPendingCafes()
    {
        $cafes = Cafe::where('status', 'Pending')->get();
        return view('admin.dashboard', compact('cafes'));
    }

    public function updateCafeStatus(Request $request, $id)
    {
        $cafe = Cafe::find($id);
        $cafe->status = $request->status;
        $cafe->save();

        return redirect()->back()->with('message', 'Cafe status updated successfully!');
    }
}
