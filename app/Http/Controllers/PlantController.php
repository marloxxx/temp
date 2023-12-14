<?php

namespace App\Http\Controllers;

use App\Imports\PlantImport;
use App\Exports\PlantExport;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //FUNGSI ELOQUENT MENAMPILKAN DATA MENGGUNAKAN PAGINATION
        $plant = $plant = DB::table('plant')->get();

        //MENGGAMBIL SEMUA ISI TABEL
        $post = Plant::orderBy('nama_plant', 'asc')->paginate(10);

        //ADD PAGINATION
        return view('plant.index', [
            'data_plant' => $plant,

            //FUNGSI LATEST UNTUK MENAMPILKAN BERDASARKAN DATA PALING AKHIR DI INPUT
            'post' => Plant::orderBy('nama_plant', 'asc')->paginate(800)


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plant.create', [
            'plant' => Plant::all()
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
            'nama_plant' => 'required',
        ]);

        Plant::create($cek);
        return redirect('/plant')
            ->with('success', 'Plant Berhasil Ditambahkan');
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
        $cek = Plant::where('id', $id)->first();
        return view('plant.edit', [
            'plant' => $cek,
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
            'nama_plant' => 'required',
        ];

        $cek = $request->validate($rules);

        Plant::where('id', $id)->update($cek);
        return redirect('/plant')->with('success', 'Plant Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Plant::destroy($id);
        return redirect('/plant')->with('success', 'Plant  Berhasil Dihapus!');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new PlantExport, 'plant.xlsx');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new PlantImport, request()->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }
    public function reset()
    {
        // Hapus semua data departemen
        Plant::truncate();
        return redirect()->route('plant.index')->with('success', 'Data plant berhasil di-reset.');
    }
}
