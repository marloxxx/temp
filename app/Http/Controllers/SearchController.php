<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMesin;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = DataMesin::where(function ($q) use ($query) {
            $q->where('nama_mesin', 'like', '%' . $query . '%')
                ->orWhere('klas_mesin', 'like', '%' . $query . '%')
                ->orWhere('nama_kategori', 'like', '%' . $query . '%')
                ->orWhere('kode_jenis', 'like', '%' . $query . '%')
                ->orWhere('type_mesin', 'like', '%' . $query . '%')
                ->orWhere('pabrik', 'like', '%' . $query . '%')
                ->orWhere('merk_mesin', 'like', '%' . $query . '%')
                ->orWhere('spek_min', 'like', '%' . $query . '%')
                ->orWhere('spek_max', 'like', '%' . $query . '%')
                ->orWhere('lok_ws', 'like', '%' . $query . '%');
        })->get();

        return view('search', ['results' => $results]);
    }
}
