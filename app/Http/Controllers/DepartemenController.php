<?php

namespace App\Http\Controllers;

use App\Imports\DepartemenImport;
use App\Exports\DepartemenExport;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //FUNGSI ELOQUENT MENAMPILKAN DATA MENGGUNAKAN PAGINATION
        $departemen = $departemen = DB::table('departemen')->get();

        //MENGGAMBIL SEMUA ISI TABEL
        $post = Departemen::orderBy('nama_departemen', 'asc')->paginate(10);

        //ADD PAGINATION
        return view('departemen.index', [
            'data_departemen' => $departemen,

            //FUNGSI LATEST UNTUK MENAMPILKAN BERDASARKAN DATA PALING AKHIR DI INPUT
            'post' => Departemen::orderBy('nama_departemen', 'asc')->paginate(100)


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departemen.create', [
            'departemen' => Departemen::all()
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
            'nama_departemen' => 'required',
        ]);

        Departemen::create($cek);
        return redirect('/departemen')
            ->with('success', 'Departemen Berhasil Ditambahkan');
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
        $cek = Departemen::where('id', $id)->first();
        return view('departemen.edit', [
            'departemen' => $cek,
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
            'nama_departemen' => 'required',
        ];

        $cek = $request->validate($rules);

        Departemen::where('id', $id)->update($cek);
        return redirect('/departemen')->with('success', 'departemen Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Departemen::destroy($id);
        return redirect('/departemen')->with('success', 'Departemen  Berhasil Dihapus!');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new DepartemenExport, 'departemen.xlsx');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new DepartemenImport, request()->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }
    public function reset()
    {
        // Hapus semua data departemen
        Departemen::truncate();
        return redirect()->route('departemen.index')->with('success', 'Data departemen berhasil di-reset.');
    }
}
