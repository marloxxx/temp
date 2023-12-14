<?php

namespace App\Http\Controllers;

use App\Models\KategoriMesin;
use App\Exports\KategoriMesinExport;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KategoriMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //FUNGSI ELOQUENT MENAMPILKAN DATA MENGGUNAKAN PAGINATION
        $kategori = $kategori = DB::table('kategorimesin')->get();

        //MENGGAMBIL SEMUA ISI TABEL
        $post = KategoriMesin::latest();

        //ADD PAGINATION
        return view('kategorimesin.index', [
            'data_kategoris' => $kategori,

            //FUNGSI LATEST UNTUK MENAMPILKAN BERDASARKAN DATA PALING AKHIR DI INPUT
            'post' => KategoriMesin::latest()->paginate(4)

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategorimesin.create', [
            'kategorimesin' => KategoriMesin::all()
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
            'nama_kategori' => 'required',
            'kode_kategori' => 'required',
        ]);

        KategoriMesin::create($cek);
        return redirect('/kategori-mesin')
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
        $tes = KategoriMesin::where('id', $id)->first();
        return view('kategorimesin.edit', [
            'kategori' => $tes,
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
            'nama_kategori' => 'required',
            'kode_kategori' => 'required',
        ];

        $validateData = $request->validate($rules);

        KategoriMesin::where('id', $id)->update($validateData);
        return redirect('/kategori-mesin')->with('success', 'Kategori Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KategoriMesin::destroy($id);
        return redirect('/kategori-mesin')->with('success', 'Data  Berhasil Dihapus!');
    }
    public function export()
    {
        return Excel::download(new KategoriMesinExport, 'Kategori.xlsx');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new KategoriMesinImport, request()->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }
    public function reset()
    {
        // Hapus semua data departemen
        KategoriMesin::truncate();
        return redirect()->route('kategorimesin.index')->with('success', 'Data plant berhasil di-reset.');
    }
}
