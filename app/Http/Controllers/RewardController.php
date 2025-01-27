<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    //
    public function create()
    {
        return view('rewards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reward_name' => 'required|string|max:255',
            'reward_description' => 'required|string',
            'points_required' => 'required|integer|min:1',
            'cafe_id' => 'required|exists:cafes,cafe_id',
        ]);
    
        $user = Auth::user();
    
        if (!$user->cafe) {
            return redirect()->back()->withErrors(['cafe_id' => 'No cafe assigned to the user.']);
        }
    
        // Retrieve the logged-in user's associated cafe ID
        $cafe_id = $user->cafe->cafe_id;
    
        // Create the reward
        Reward::create([
            'reward_name' => $request->reward_name,
            'reward_description' => $request->reward_description,
            'points_required' => $request->points_required,
            'cafe_id' => $cafe_id,
        ]);
    
        return redirect()->route('rewards.manage', ['cafe' => $cafe_id])->with('message', 'Reward created successfully.');
    }

    public function edit($id)
    {
        // Find the reward by ID
        $reward = Reward::findOrFail($id);
    
        // Ensure the reward belongs to the user's cafe
        $user = Auth::user();
        if ($reward->cafe_id !== $user->cafe->cafe_id) {
            return redirect()->route('rewards.manage')->with('message', 'Unauthorized access to this reward.');
        }
    
        return view('rewards.edit', compact('reward'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'reward_name' => 'required|string|max:255',
            'reward_description' => 'required|string',
            'points_required' => 'required|integer|min:1',
        ]);
    
        // Find the reward by ID
        $reward = Reward::findOrFail($id);
        
    
        // Ensure the reward belongs to the user's cafe
        $user = Auth::user();
        // Retrieve the logged-in user's associated cafe ID
        $cafe_id = $user->cafe->cafe_id;

        if ($reward->cafe_id !== $user->cafe->cafe_id) {
            return redirect()->route('rewards.manage', ['cafe' => $cafe_id])->with('message', 'Unauthorized access to this reward.');
        }
    
        // Update the reward
        $reward->update([
            'reward_name' => $request->reward_name,
            'reward_description' => $request->reward_description,
            'points_required' => $request->points_required,
        ]);
    
        return redirect()->route('rewards.manage', ['cafe' => $cafe_id])->with('message', 'Reward updated successfully.');
    }

    public function destroy($id)
    {
        // Find the reward by ID
        $reward = Reward::findOrFail($id);
    
        // Ensure the reward belongs to the user's cafe
        $user = Auth::user();
        // Retrieve the logged-in user's associated cafe ID
        $cafe_id = $user->cafe->cafe_id;

        if ($reward->cafe_id !== $user->cafe->cafe_id) {
            return redirect()->route('rewards.manage')->with('message', 'Unauthorized access to this reward.');
        }
    
        // Delete the reward
        $reward->delete();
    
        return redirect()->route('rewards.manage', ['cafe' => $cafe_id])->with('message', 'Reward deleted successfully.');
    }

    public function manage(Cafe $cafe)
    {
        $user = Auth::user();
        if (!$user->cafe) {
            return redirect()->route('/')->with('error', 'No cafe assigned to this user.');
        }
    
        $cafe_id = $user->cafe->cafe_id;
    
        $rewards = Reward::where('cafe_id', $cafe_id)->get();
    
        return view('rewards.manage', compact('rewards', 'cafe'));
    }



}
