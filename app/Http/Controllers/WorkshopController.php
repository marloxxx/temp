<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Exports\WorkshopExport;
use App\Imports\WorkshopImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //FUNGSI ELOQUENT MENAMPILKAN DATA MENGGUNAKAN PAGINATION
        $kategori = $kategori = DB::table('workshop')->get();

        //MENGGAMBIL SEMUA ISI TABEL
        $post = Workshop::orderBy('nama_workshop', 'asc')->paginate(10);

        //ADD PAGINATION
        return view('workshop.index', [
            'data_kategoris' => $kategori,

            //FUNGSI LATEST UNTUK MENAMPILKAN BERDASARKAN DATA PALING AKHIR DI INPUT
            'post' => Workshop::orderBy('nama_workshop', 'asc')->paginate(800)


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workshop.create', [
            'workshop' => Workshop::all()
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
            'nama_workshop' => 'required',
            'keterangan' => '',
        ]);

        Workshop::create($cek);
        return redirect('/lokasi-workshop-mesin')
            ->with('success', 'Lokasi Workshop Berhasil Ditambahkan');
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
        $tes = Workshop::where('id', $id)->first();
        return view('workshop.edit', [
            'workshop' => $tes,
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
            'nama_workshop' => 'required',
            'keterangan' => 'required',
        ];

        $validateData = $request->validate($rules);

        Workshop::where('id', $id)->update($validateData);
        return redirect('/lokasi-workshop-mesin')->with('success', 'Workshop Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Workshop::destroy($id);
        return redirect('/lokasi-workshop-mesin')->with('success', 'Data  Berhasil Dihapus!');
    }
    public function export()
    {
        return Excel::download(new WorkshopExport, 'workshop.xlsx');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new WorkshopImport, request()->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }
    public function reset()
    {
        // Hapus semua data departemen
        Workshop::truncate();
        return redirect()->route('workshop.index')->with('success', 'Data plant berhasil di-reset.');
    }
}
