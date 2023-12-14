<?php

namespace App\Http\Controllers;

use App\Models\Pelaporan;
use Illuminate\Http\Request;

class HistoryPelaporanController extends Controller
{
    public function index($id) {
        $data = Pelaporan::where('datamesin_id', $id)->get();
        return view('history-pelaporan.index', compact('data'));
    }
}
