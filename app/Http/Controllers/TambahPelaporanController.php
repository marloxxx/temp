<?php

namespace App\Http\Controllers;

use App\Models\DataMesin;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TambahPelaporanController extends Controller
{
    public function index()
    {
        return view('tambah-pelaporan.index');
    }

    public function getDataMesin(Request $request)
    {
        $qrCode = $request->input('result');
        $mesin = DataMesin::where('kode_jenis', $qrCode)->first();

        $dataMesin = [
            'id'            => null,
            'nama_mesin'     => null,
            'kategori'   => null,
            'merk'       => null,
            'lokasi'     => null,
            'gamabr'     => null
        ];

        if ($mesin) {
            $dataMesin = [
                'id'        => $mesin->id,
                'nama_mesin' => $mesin->nama_mesin,
                'kategori'  => $mesin->kategori->nama_kategori,
                'merk'      => $mesin->merk_mesin,
                'lokasi'    => $mesin->workshop->nama_workshop,
                'gambar'    => $mesin->gambar_mesin,
            ];
        }

        return response()->json($dataMesin);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_kerusakan' => 'required',
            'deskripsi' => 'required'
        ], [
            'tanggal_kerusakan.required'   => 'Form wajib diisi !',
            'deskripsi.required'    => 'Form wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->file('gambar')) {
            $gambar_laporan = $request->file('gambar')->store('laporan', 'public');
        }

        Pelaporan::create([
            'no_registrasi' => $request->registrasi,
            'id_pemohon' => $request->id_pemohon,
            'tanggal_permintaan' => $request->tanggal_permintaan,
            'tanggal_kerusakan' => $request->tanggal_kerusakan,
            'deskripsi' => $request->deskripsi,
            'datamesin_id' => $request->id_mesin,
            'gambar_laporan' => $gambar_laporan,
        ]);

        return redirect('/pelaporan/cek')->with('success', 'Berhasil menambahkan pelaporan baru');
    }

    public function getSpekMesin(Request $request)
    {
        $id = $request->input('id');
        $dataMesin = DataMesin::where('id', $id)->first();

        if ($dataMesin) {
            $data = [
                'id'        => $dataMesin->id,
                'gambar_mesin'    => $dataMesin->gambar_mesin,
                'kode_jenis' => $dataMesin->kode_jenis,
                'nama_kategori'  => $dataMesin->kategori->nama_kategori,
                'nama_klasifikasi' => $dataMesin->klasifikasi->nama_klasifikasi,
                'nama_mesin' => $dataMesin->nama_mesin,
                'type_mesin' => $dataMesin->type_mesin,
                'merk_mesin'      => $dataMesin->merk_mesin,
                'spek_min'      => $dataMesin->spek_min,
                'spek_max'      => $dataMesin->spek_max,
                'pabrik' => $dataMesin->pabrik,
                'kapasitas'      => $dataMesin->kapasitas,
                'tahun_mesin'      => $dataMesin->tahun_mesin,
                'lok_ws'      => $dataMesin->lok_ws,
            ];
        }

        return response()->json($data);
    }
}
