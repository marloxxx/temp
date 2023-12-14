<?php

namespace App\Http\Controllers;

use App\Models\DataAnggota;
use App\Models\DataBuku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function pengembalian($id){
        $cek=Peminjaman::where('id', $id)->first();
        return view('pengembalian.create', [
            'pengembalians' => $cek,
            'users'=> User::all(),
            'data_anggotas'=>DataAnggota::all(),
            'data_bukus'=>DataBuku::all()
        ]);
    }

    // public function transaksi($id, Request $request){
    //     $peminjaman=Peminjaman::where('id', $id)->first();
    //     $lamasewa=$peminjaman->lama_peminjaman*24;
    //     $tenggang=date('Y-m-d', strtotime($peminjaman->tanggal_pinjam.'+'.$lamasewa.'hours'));
    //     $tanggalkembali=Carbon::parse($request->tanggal_kembali);
    //     $selisihhari=$tanggalkembali->diffInDays($tenggang);
    //     $denda=$selisihhari*5000;
    //     // dd($request->tanggal_kembali);
    //     if($request->tanggal_kembali>$tenggang){
    //         $pengembalian=new Pengembalian;
    //         $pengembalian->peminjaman_id=$peminjaman->id;
    //         $pengembalian->tanggal_kembali=$request->tanggal_kembali;
    //         $pengembalian->denda=$denda;
    //         $pengembalian->save();
    //     }
    //     $pengembalian=new Pengembalian;
    //     $pengembalian->peminjaman_id=$peminjaman->id;
    //     $pengembalian->tanggal_kembali=$request->tanggal_kembali;
    //     $pengembalian->save();
    //     $peminjaman->status=2;
    //     $peminjaman->save();
    //     return redirect('/pengembalian/index');
    // }

    public function view(){
        $cek=Pengembalian::all();
        return view('pengembalian.index', [
            'pengembalians' => $cek,
        ]);
    }

    
}
