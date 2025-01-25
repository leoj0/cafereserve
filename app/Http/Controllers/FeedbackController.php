<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index(Cafe $cafe)
    {
        // Retrieve feedbacks for the specified cafe
        $feedbacks = Feedback::where('cafe_id', $cafe->cafe_id)->get();

        // Pass the feedbacks and cafe to the view
        return view('feedbacks.index', compact('feedbacks', 'cafe'));
    }

    public function show($cafeId)
    {
        $cafe = Cafe::with(['feedbacks.user'])->findOrFail($cafeId);
        return view('cafe.show', [
            'cafe' => $cafe,
            'feedbacks' => $cafe->feedbacks
        ]);
    }

    public function create()
    {
        // Fetch all cafes
        $cafes = Cafe::all();
        return view('feedbacks.create', compact('cafes'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $formfields = $request->validate([
            'cafe_id' => 'required|exists:cafes,cafe_id',
            'rating' => 'required|integer|between:1,5',
            'comments' => 'required|string',
        ]);

        $formfields['user_id'] = auth()->id();

        // Create feedback record
        $feedback = Feedback::create($formfields);
        $feedback->awardLoyaltyPoints();

        return redirect()->route('landing')->with('message', 'Feedback submitted successfully and 5 points added');
    }

    public function userFeedbacks(Request $request)
    {
        $user = auth()->user();
    
        // Get the cafe ID from the request, if provided
        $cafeId = $request->input('cafe_id');
    
        // Fetch feedbacks for the user, optionally filtering by cafe ID
        $query = Feedback::where('user_id', $user->user_id);
    
        if ($cafeId) {
            $query->where('cafe_id', $cafeId); // Filter feedbacks by cafe_id if provided
        }
    
        $feedbacks = $query->with('cafe')->get(); // Eager load the related cafe
    
        return view('feedbacks.user-feedback', compact('feedbacks'));
    }

    // Show the form for editing the user's feedback
    public function edit(Feedback $feedback)
    {
        // Check if the logged-in user owns the feedback
        if (Auth::id() !== $feedback->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('feedbacks.edit', compact('feedback'));
    }

    // Update the user's feedback
    public function update(Request $request, Feedback $feedback)
    {
        // Check if the logged-in user owns the feedback
        if (Auth::id() !== $feedback->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the input
        $request->validate([
            'comments' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);


        // Update the feedback
        $feedback->update([
            'comments' => $request->input('comments'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->route('feedback.user')
            ->with('message', 'Feedback updated successfully.');
    }

    // Delete the user's feedback
    public function destroy(Feedback $feedback)
    {
        // Check if the logged-in user owns the feedback
        if (Auth::id() !== $feedback->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the feedback
        $feedback->delete();

        return redirect()->route('feedback.user')
            ->with('message', 'Feedback deleted successfully.');
    }

    public function ownerFeedbacks(Cafe $cafe)
    {
        // Retrieve the cafe with its feedback and associated users
        $cafe = Cafe::with('feedbacks.user')->findOrFail($cafe->cafe_id);
    
        return view('feedbacks.owner-feedback', compact('cafe'));
    }

}


