<?php

namespace App\Http\Controllers;

use App\Models\DataKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class DataKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //FUNGSI ELOQUENT MENAMPILKAN DATA MENGGUNAKAN PAGINATION
        $kategori = $kategori = DB::table('data_kategoris')->get();

        //MENGGAMBIL SEMUA ISI TABEL
        $post = DataKategori::latest();

        //ADD PAGINATION
        return view('kategori.index', [
            'data_kategoris' => $kategori,

            //FUNGSI LATEST UNTUK MENAMPILKAN BERDASARKAN DATA PALING AKHIR DI INPUT
            'post' => DataKategori::latest()->paginate(4)

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create', [
            'data_kategoris' => DataKategori::all()
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
            'deskripsi' => 'required',
        ]);
        if ($request->file('image')) {
            $cek['image'] = $request->file('image')->store('data_kategoris', 'public');
        }
        DataKategori::create($cek);
        return redirect('/datakategori')
            ->with('success', 'Kategori Mesin Berhasil Ditambahkan');
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
        $tes = DataKategori::where('id', $id)->first();
        return view('kategori.edit', [
            'data_kategoris' => $tes,
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
            'deskripsi' => 'required',
        ];

        $validateData = $request->validate($rules);
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('datakategori', 'public');
        }

        DataKategori::where('id', $id)->update($validateData);
        return redirect('/datakategori')->with('success', 'Kategori Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DataKategori::destroy($id);
        return redirect('/datakategori')->with('success', 'Kategori Buku Berhasil Dihapus!');
    }

    public function cetak_pdf()
    {
        $articles = DataKategori::all();
        $pdf = PDF::loadview('kategori.printpdf', ['data_kategoris' => $articles]);
        return $pdf->stream();
    }
}
