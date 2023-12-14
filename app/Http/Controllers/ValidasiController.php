<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Validasi;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $validasi = Validasi::where('action_to_do', 'R')->with('user')->get();
        $histori = Validasi::where('action_to_do', '!=', 'R')->with('user')->get();

        return view('perbaikan.validasi.index', compact('validasi', 'histori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Validasi $validasi)
    {
        $validasi->update([
            'action_to_do' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        $pengajuan = Pengajuan::find($validasi->pengajuan_id);

        $pengajuan->update([
            'st_pengajuan' => $request->status
        ]);

        return redirect()->route('validasi.index')->with('success', 'Pengajuan Surat Berhasil Divalidasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
