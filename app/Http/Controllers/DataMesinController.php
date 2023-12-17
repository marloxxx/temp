<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Workshop;
use App\Models\DataMesin;
use App\Models\KlasMesin;
use App\Models\Klasifikasi;
use Laravel\Ui\Presets\Vue;
use App\Models\DataKategori;
use App\Models\NoRegistrasi;
use Illuminate\Http\Request;
use App\Models\KategoriMesin;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DataMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $kategori = KategoriMesin::all();
        $klasifikasi = KlasMesin::all();
        return view('mesin.index', compact('kategori', 'klasifikasi'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengambil ID terbaru dari database
        $latestJenis = KategoriMesin::latest()->first();

        if ($latestJenis) {
            $latestID = $latestJenis->id; // Mengambil ID terbaru
            $newID = $latestID + 1;
            $newKode = str_pad($newID, 3, '0', STR_PAD_LEFT);
        } else {
            $newKode = '001'; // Jika belum ada data
        }

        return view('mesin.create', [
            'kodeJenis' => $newKode,
            // Sertakan data lain yang Anda perlukan di tampilan di sini
            'users' => User::all(),
            'workshop' => Workshop::all(),
            'noregistrasi' => NoRegistrasi::all(),
            'kategorimesin' => KategoriMesin::all(),
            'kategori' => Kategori::all(),
            'klasmesin' => KlasMesin::all(),
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

        $validator = Validator::make($request->all(), [
            'nama_mesin' => 'required',
            'tahun_mesin' => 'required',
            'kategori' => 'required|exists:kategorimesin,id',
            'klasifikasi' => 'required|exists:klasmesin,id',
            'kode_jenis' => 'required',
            'type_mesin' => 'required',
            'merk_mesin' => 'required',
            'spek_min' => 'required',
            'spek_max' => '',
            'lok_ws' => 'required',
            'kapasitas' => '',
            'pabrik' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/data-mesin/create')
                ->withErrors($validator)
                ->withInput();
        }
        $kategorimesin = KategoriMesin::where('id', $request->kategori)->first();
        $klasmesin = KlasMesin::where('id', $request->klasifikasi)->first();
        $fileNama = null;
        if ($request->file('gambar_mesin')) {
            $file = $request->file('gambar_mesin');
            $fileNama = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('datamesin', $fileNama, 'public');
        }

        DataMesin::create([
            'no_mesin' => $request->no_mesin,
            'klas_mesin' => $klasmesin->nama_klasifikasi,
            'nama_mesin' => $request->nama_mesin,
            'type_mesin' => $request->type_mesin,
            'merk_mesin' => $request->merk_mesin,
            'spek_min' => $request->spek_min,
            'spek_max' => $request->spek_max,
            'pabrik' => $request->pabrik,
            'kapasitas' => $request->kapasitas,
            'tahun_mesin' => $request->tahun_mesin,
            'lok_ws' => $request->lok_ws,
            'gambar_mesin' => $fileNama,
            'nama_kategori' => $kategorimesin->nama_kategori,
            'nama_klasifikasi' => $klasmesin->nama_klasifikasi,
            'kode_kategori' => $kategorimesin->id,
            'kode_klasifikasi' => $klasmesin->id,
            'kode_jenis' => $request->kode_jenis,
        ]);

        return redirect('/data-mesin')
            ->with('success', 'Data sudah tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tes = DataMesin::where('id', $id)->first();
        return view('mesin.detail', [
            'datamesin' => $tes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tes = DataMesin::find($id)->load('kategori', 'klasifikasi');
        return view('mesin.edit', [
            'datamesin' => $tes,
            'users' => User::all(),
            'kategorimesin' => KategoriMesin::all(),
            'klasmesin' => KlasMesin::all(),
            'workshop' => Workshop::all()

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
            'kategori' => 'required|exists:kategorimesin,id',
            'klasifikasi' => 'required|exists:klasmesin,id',
            'nama_mesin' => 'required',
            'type_mesin' => 'required',
            'merk_mesin' => 'required',
            'spek_min' => 'required',
            'pabrik' => 'required',
            'tahun_mesin' => 'required',
            'kapasitas' => '',
            'lok_ws' => 'required',
            'gambar_mesin' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah aturan validasi untuk gambar
        ];

        $validateData = $request->validate($rules);

        $kategorimesin = KategoriMesin::where('id', $request->kategori)->first();
        $klasmesin = KlasMesin::where('id', $request->klasifikasi)->first();

        $validateData['nama_kategori'] = $kategorimesin->nama_kategori;
        $validateData['kode_kategori'] = $kategorimesin->kode_kategori;
        $validateData['nama_klasifikasi'] = $klasmesin->nama_klasifikasi;
        $validateData['kode_klasifikasi'] = $klasmesin->kode_klasifikasi;

        $update = DataMesin::find($id);
        $update->klas_mesin = $request->klas_mesin;
        $update->nama_mesin = $request->nama_mesin;
        $update->type_mesin = $request->type_mesin;
        $update->merk_mesin = $request->merk_mesin;
        $update->spek_min = $request->spek_min;
        $update->spek_max = $request->spek_max; // Tambahkan kolom spek_max sesuai kebutuhan
        $update->pabrik = $request->pabrik;
        $update->kapasitas = $request->kapasitas; // Tambahkan kolom kapasitas sesuai kebutuhan
        $update->tahun_mesin = $request->tahun_mesin;
        $update->lok_ws = $request->lok_ws;
        $update->kode_jenis = $request->kode_jenis;

        // Tambahkan kondisi untuk menghapus gambar lama jika ada gambar baru yang diunggah
        if ($request->file('gambar_mesin')) {
            if ($update->gambar_mesin) {
                Storage::delete($update->gambar_mesin);
            }
            $update->gambar_mesin = $request->file('gambar_mesin')->store('datamesin', 'public');
        }

        $update->save();

        return redirect('/data-mesin')->with('success', 'Data sudah diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DataMesin::destroy($id);
        return redirect('/data-mesin')->with('success', 'Data sudah dihapus!');
    }

    public function cetak_pdf()
    {
        $articles = DataMesin::all();
        $pdf = PDF::loadview('mesin.printpdf', ['datamesin' => $articles]);
        return $pdf->stream();
    }
    public function getKlasifikasi(Request $request)
    {
        $klasifikasi = Klasifikasi::where('kategori_id', $request->kategori_id)->pluck('nama', 'id');
        return response()->json($klasifikasi);
    }

    public function getLatestID(Request $request)
    {
        $latestID = DataMesin::latest()->value('id');
        return response()->json(['latestID' => $latestID]);
    }

    public function getLatestmESIN($kategoriID, $klasifikasiID, $tahun)
    {
        $latest = DataMesin::where('kode_kategori', $kategoriID)
            ->where('kode_klasifikasi', $klasifikasiID)->latest('kode_jenis')->value('kode_jenis');
        if ($latest != null) {
            return response()->json(['latest' => $latest]);
        } else {
            return response()->json(['latest' => '']);
        }
    }

    public function getLatestbyId($kategoriID, $klasifikasiID, $id)
    {
        $latest = DataMesin::where('nama_kategori', $kategoriID)
            ->where('klas_mesin', $klasifikasiID)->latest('kode_jenis')->value('kode_jenis');
        $current = DataMesin::where('id', $id)->first();

        if ($latest != null) {
            return response()->json([
                'latest' => $latest,
                'current' => $current
            ]);
        } else {
            return response()->json([
                'latest' => '',
                'current' => null
            ]);
        }
    }

    public function getKategoriData()
    {
        $kategoriData = KategoriMesin::all();
        return response()->json($kategoriData);
    }

    public function getKlasifikasiData($kategori)
    {
        $klasifikasiData = KlasMesin::where('kategorimesin', $kategori)->get();
        return response()->json($klasifikasiData);
    }

    /**
     * Menampilkan kategori.
     *
     * @return response()
     */
    public function getKategorimesin() // Ubah "Kategori" menjadi "getKategori"
    {
        $data['kategorimesin'] = kategorimesin::get(["nama_kategori", "id"]);
        return view('home.index', $data);
    }

    /**
     * Mendapatkan klasifikasi berdasarkan kategori.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getklasmesin(Request $request) // Ubah "klasifikasi" menjadi "getKlasifikasi"
    {
        $data['klasmesin'] = klasmesin::where("kategorimesin_id", $request->kategorimesin_id)
            ->get(["nama_klasifikasi", "id", "kode_klasifikasi"]);

        return response()->json($data);
    }
    public function countEntriesByKategori(Request $request)
    {
        // Validasi input (pastikan ada kategori_id yang diberikan)
        $request->validate([
            'kategori_id' => 'required|exists:kategorimesin,id',
        ]);

        // Hitung jumlah entri berdasarkan kategori_id
        $kategoriId = $request->input('kategori_id');
        $count = DataMesin::where('id_kategori', $kategoriId)->count();

        // Kembalikan hasil dalam format JSON
        return response()->json(['count' => $count]);
    }
    public function reset()
    {
        // Pernyataan SQL untuk menghapus semua data dari tabel datamesin
        DB::table('datamesin')->truncate();

        return redirect('/data-mesin')->with('success', 'Data sudah direset!');
    }

    public function getDataMesin()
    {
        $dataMesin = DataMesin::all();

        return DataTables::of($dataMesin)
            ->addColumn('DT_RowIndex', function ($data) {
                return $data->id;
            })
            ->addColumn('nama_kategori', function ($data) {
                return $data->kategori->nama_kategori;
            })
            ->addColumn('nama_klasifikasi', function ($data) {
                return $data->klasifikasi->nama_klasifikasi;
            })
            ->addColumn('action', function ($data) {
                return '<button>Edit</button>';
            })
            ->rawColumns(['action', 'nama_kategori', 'nama_klasifikasi'])
            ->make(true);
    }
}
