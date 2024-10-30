<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use App\Models\Feedback;

class LandingController extends Controller
{
    public function index(Cafe $cafe)
    {
        $cafes = Cafe::all();
        $feedbacks = Feedback::latest()->take(4)->get();

        return view('landing.index', compact('cafes', 'feedbacks'));
    }
}
