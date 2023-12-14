<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman as ModelsPeminjaman;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;


class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if(isset($_GET['datefrom']))
        {
            $from_date = $request['datefrom'];
    	    $to_date   = $request['dateto'];
        }
        else
        {
            $from_date = getdate();
    	    $to_date   = getdate();
        }
        

       // $from_date = '2022-05-01';
    	//$to_date = '2022-07-29';
    	
        return view('laporan.index',[
            'laporanPeminjaman'=> Peminjaman::where('tanggal_pinjam', '>=', $from_date)
            ->where('tanggal_pinjam', '<=', $to_date)->get(),
            'laporanPengembalian'=> Pengembalian::where('tanggal_kembali', '>=', $from_date)
            ->where('tanggal_kembali', '<=', $to_date)->get()
        ]);
    }

}
