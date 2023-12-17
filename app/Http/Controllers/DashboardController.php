<?php

namespace App\Http\Controllers;

use App\Models\DataAnggota;
use App\Models\DataBuku;
use App\Models\DataKategori;
use App\Models\DataMesin;
use App\Models\Peminjaman as ModelsPeminjaman;
use App\Models\Pengembalian;
use App\Models\KategoriMesin;
use App\Models\KlasMesin;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // get nama kategori and how many mesin in that kategori
        $jumlahKategori = DataMesin::select('nama_kategori', DB::raw('count(*) as total'))
            ->groupBy('nama_kategori')
            ->orderBy('nama_kategori')
            ->get();

        $jumlahKlasifikasi = DataMesin::select('klas_mesin', DB::raw('count(*) as total'))
            ->groupBy('klas_mesin')
            ->orderBy('klas_mesin')
            ->get();

        return view('index', [
            'jumlahKategori' => $jumlahKategori,
            'jumlahKlasifikasi' => $jumlahKlasifikasi,
            'jumlah_anggota' => DataAnggota::count(),
            'jumlah_petugas' => User::count(),
            'jumlah_buku' => DataBuku::count(),
            'jumlah_mesin' => DataMesin::count(),
            'jumlah_kategori' => KategoriMesin::count(),
            'jumlah_klasifikasi' => KlasMesin::count(),
            'jumlah_kategori' => KategoriMesin::count(),
            'jumlah_pengembalian' => Pengembalian::count(),
            'jumlah_peminjaman' => ModelsPeminjaman::count()
        ]);
    }
}
