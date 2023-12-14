<?php

namespace App\Http\Controllers;

use App\Models\KategoriMesin;
use App\Models\KlasMesin;
use App\Imports\KlasmesinImport;
use App\Exports\KlasmesinExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KlasMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all data from the 'kategorimesin' table
        $data_kategoris = KategoriMesin::all();

        // Fetch all data from the 'klasmesin' table, ordered by 'nama_klasifikasi'
        $post = KlasMesin::orderBy('nama_klasifikasi', 'asc')->latest()->paginate(500);

        // Pass the data to the view
        return view('klasmesin.index', [
            'data_kategoris' => $data_kategoris,
            'post' => $post,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('klasmesin.create', [
            'klasmesin' => KlasMesin::all(),
            'kategorimesin' => KategoriMesin::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = $request->validate([
            'nama_klasifikasi' => 'required',
            'kode_klasifikasi' => 'required',
            'kategorimesin_id' => 'required',
        ]);

        KlasMesin::create($cek);
        return redirect('/klasifikasi-mesin')
            ->with('success', 'Kategori Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tes = KlasMesin::where('id', $id)->first();
        return view('klasmesin.edit', [
            'klasmesin' => $tes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama_klasifikasi' => 'required',
            'kode_klasifikasi' => 'required',
        ];

        $validateData = $request->validate($rules);

        KlasMesin::where('id', $id)->update($validateData);
        return redirect('/klasifikasi-mesin')->with('success', 'Klasifikasi Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KlasMesin::destroy($id);
        return redirect('/klasifikasi-mesin')->with('success', 'Data  Berhasil Dihapus!');
    }

    public function export()
    {
        return Excel::download(new KlasMesinExport, 'klasifikasi.xlsx');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new KlasMesinImport, request()->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }
    public function reset()
    {
        // Hapus semua data departemen
        KlasMesin::truncate();
        return redirect()->route('plant.index')->with('success', 'Data plant berhasil di-reset.');
    }
}
