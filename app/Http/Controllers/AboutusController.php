<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AboutusController extends Controller
{
    /**
     * Show the about us page.
     */
    public function index()
    { 
        $user = Auth::user();
        
        return view('aboutus', compact(  'user'));
    }
}
