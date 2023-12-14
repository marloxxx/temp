<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataMesinImport;
use App\Exports\DataMesinExport;

class MesinImportEksportController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function ImportExport()
    {
        return view('file-import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function DataMesinImport(Request $request)
    {
        Excel::import(new DataMesinImport, $request->file('file')->store('temp'));
        return redirect('/data-mesin')->with('success', 'Berhasil Dimport');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function DataMesinExport()
    {
        return Excel::download(new DataMesinExport, 'daftar-mesin.xlsx');
    }
}
