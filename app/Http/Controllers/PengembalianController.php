<?php

namespace App\Http\Controllers;


use App\Models\DataAnggota;
use App\Models\DataBuku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengembalian.index',[
            'pengembalians'=> Pengembalian::all()->sortBy('tanggal_kembali')->values(),
            'peminjaman' => Peminjaman::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tes=$request->validate([
            'peminjaman_id' => 'required',
            'tanggal_kembali' => 'required',
            ]);

        $peminjaman=Peminjaman::where('id', $request->peminjaman_id)->first();
        $lamasewa=$peminjaman->lama_peminjaman*24;
        $tenggang=date('Y-m-d', strtotime($peminjaman->tanggal_pinjam.'+'.$lamasewa.'hours'));
        $tanggalkembali=Carbon::parse($request->tanggal_kembali);
        $selisihhari=$tanggalkembali->diffInDays($tenggang);
        $denda=$selisihhari*5000;
        // dd($request->tanggal_kembali);
        if($request->tanggal_kembali>$tenggang){
            $pengembalian=new Pengembalian;
            $pengembalian->peminjaman_id=$peminjaman->id;
            $pengembalian->tanggal_kembali=$request->tanggal_kembali;
            $pengembalian->denda=$denda;
            $pengembalian->save();
        }else{
            $pengembalian=new Pengembalian;
            $pengembalian->peminjaman_id=$peminjaman->id;
            $pengembalian->tanggal_kembali=$request->tanggal_kembali;
            $pengembalian->save();
        }
        $peminjaman->status=2;
        $peminjaman->update($tes);
        return redirect('/pengembalian')->with('success', 'Pengembalian Berhasil Di Tambah!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengembalian $pengembalian)
    {
        Pengembalian::destroy($pengembalian->id);
        return redirect('/pengembalian')->with('success', 'Pengembalian Berhasil Dihapus!');
    }

     public function cetak_pdf(){
        $articles = Pengembalian::all();
        $pdf = PDF::loadview('pengembalian.printpdf',['pengembalians'=>$articles]);
        return $pdf->stream();
    }
}