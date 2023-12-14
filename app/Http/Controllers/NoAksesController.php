<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoAksesController extends Controller
{
    public function index()
    {
        return view('noakses.index'); // Ganti "noakases" menjadi "noakses"
    }
}
