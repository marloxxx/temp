<?php

namespace App\Http\Controllers;

use App\Models\DataMesin;
use App\Models\Workshop;
use App\Models\KlasMesin;
use App\Models\DataKategori;
use App\Models\KategoriMesin;
use App\Models\NoRegistrasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Klasifikasi;
use App\Models\Kategori;

class PerbaikanController extends Controller
{
    public function index()
    {
        $dataMesin = DataMesin::with('kategori', 'klasifikasi')
            ->orderBy('nama_kategori', 'asc')
            ->get();

        return view('perbaikan.spekpublik.detail', [
            'datamesin' => $dataMesin
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tes = DataMesin::where('id', $id)->first();
        return view('perbaikan.spekpublik.detail', [
            'datamesin' => $tes,
        ]);
    }
}
