<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicomsysController extends Controller
{
    /**
     * Display the modern TycomSys homepage
     */
    public function index()
    {
        return view('tycomsys-home');
    }
}

