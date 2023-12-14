<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\DataMesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermintaanController extends Controller
{
    public function index()
    {
        return view('pelaporan.permintaan.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $mesin = DataMesin::where('id', $id);
        $namaMesin = $mesin->pluck('nama_mesin')->first();
        $idMesin = $mesin->pluck('id')->first();
        $registrasi = $this->generateNomorRegistrasi();
        $pemohon = Auth::user();

        return view('pelaporan.permintaan.create', compact('registrasi', 'pemohon', 'namaMesin', 'idMesin'));
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
            'nama' => 'required',
        ]);

        Plant::create($cek);
        return redirect('/pengajuan1')
            ->with('success', 'Plant Berhasil Ditambahkan');
    }

    function generateNomorRegistrasi()
    {
        $lastNumber = DB::table('datamesin')->max('id');
        $lastNumber = $lastNumber ? $lastNumber + 1 : 1;

        $lastLaporan = DB::table('pelaporans')->max('id');
        $lastLaporan = $lastLaporan ? $lastLaporan + 1 : 1;

        $month = $this->numberToRomanRepresentation(date('m'));

        return str_pad($lastLaporan, 3, '0', STR_PAD_LEFT).sprintf('/WS/'.$month.'/%d', date('Y')) . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
    }

    function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
