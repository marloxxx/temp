<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Klasifikasi;

class DropDownController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('datamesin.dropdown', compact('kategori'));
    }

    public function getklasifikasi(Request $request)
    {
        $namaKategori = $request->nama_kategori;

        // Gantilah 'nama_kategori' dengan nama kolom yang sesuai pada model Kategori
        $kategori = Kategori::where('nama', $namaKategori)->first();

        if ($kategori) {
            $klasifikasi = Klasifikasi::where('kategori_id', $kategori->id)->pluck('id', 'nama');
            return response()->json($klasifikasi);
        }

        return response()->json([]); // Jika tidak ada kategori yang sesuai
    }
}
