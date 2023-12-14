<?php

namespace App\Http\Controllers;

use \App\Models\NoRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class NoRegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //FUNGSI ELOQUENT MENAMPILKAN DATA MENGGUNAKAN PAGINATION
        $kategori = $kategori = DB::table('noregistrasi')->get();

        //MENGGAMBIL SEMUA ISI TABEL
        $post = NoRegistrasi::latest();

        //ADD PAGINATION
        return view('noregistrasi.index', [
            'data_kategoris' => $kategori,

            //FUNGSI LATEST UNTUK MENAMPILKAN BERDASARKAN DATA PALING AKHIR DI INPUT
            'post' => NoRegistrasi::latest()->paginate(4)

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noregistrasi.create', [
            'noregistrasi' => NoRegistrasi::all()
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
            'reg_mesin' => '',
        ]);

        NoRegistrasi::create($cek);
        return redirect('/noregistrasi-mesin')
            ->with('success', 'Berhasil Ditambahkan');
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
        $tes = NoRegistrasi::where('id', $id)->first();
        return view('noregistrasi.edit', [
            'noregistrasi' => $tes,
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
            'kode_registrasi' => 'required',
        ];

        $validateData = $request->validate($rules);

        NoRegistrasi::where('id', $id)->update($validateData);
        return redirect('/noregistrasi-mesin')->with('success', 'Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NoRegistrasi::destroy($id);
        return redirect('/noregistrasi-mesin')->with('success', 'Data  Berhasil Dihapus!');
    }
}
