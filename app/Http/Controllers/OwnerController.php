<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        // Logic to show the owner's dashboard
        return view('owners.index');
    }
}
