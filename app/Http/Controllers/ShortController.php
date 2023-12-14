<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShortController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter sort dan order dari permintaan
        $sortColumn = $request->input('sort', 'kodeJenis');
        $sortDirection = $request->input('order', 'asc'); // Arah pengurutan default adalah naik (asc)

        // Mengambil data mesin dan mengurutkannya sesuai parameter
        $dataMesin = DataMesin::orderBy($sortColumn, $sortDirection)->get();

        return view('mesin.index', [
            'datamesin' => $dataMesin,
        ]);
    }
}
