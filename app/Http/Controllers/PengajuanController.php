<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Validasi;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuan = Pengajuan::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $histori = Validasi::where('user_id', Auth::user()->id)->get();

        return view('perbaikan.pengajuan.index', compact('pengajuan', 'histori'));
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
        $cekPengajuan = Pengajuan::where(['st_pengajuan' => 'R', 'user_id' => Auth::user()->id])->first();

        if ($cekPengajuan) {
            return redirect()->route('pengajuan.index')->with('error', 'Pengajuan Sudah Ada, Silahkan Tunggu Proses Hingga Selesai');
        }

        $id = Pengajuan::create([
            'user_id' => Auth::user()->id,
            'dari_tanggal' => $request->dari_tanggal,
            'ke_tanggal' => $request->ke_tanggal,
            'keterangan' => $request->keterangan,
            'st_pengajuan' => 'R',
            'nama_ws' => $request->nama_ws, // Assuming you have a field named 'nama_ws'
            'nama_alatmesink3' => $request->nama_alatmesink3, // Add this line with the correct field name
        ]);

        Validasi::create([
            'user_id' => Auth::user()->id,
            'pengajuan_id' => $id->id,
            'action_to_do' => 'R',
            'keterangan' => '',
            'nama_ws' => $request->nama_ws, // Assuming you have a field named 'nama_ws'
            'nama_alatmesink3' => $request->nama_alatmesink3, // Add this line with the correct field name
        ]);

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
    /**
     * Retrieve workshops from the Workshop model.
     */
    public function Workshop()
    {
        $workshops = Workshop::all();
        return $workshops;
    }
}
