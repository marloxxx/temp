<?php

namespace App\Http\Controllers;

use App\Models\DataMesin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{

    public function showQRCode($kode_jenis)
    {
        // Mengambil data mesin berdasarkan kode jenis
        $mesin = DataMesin::where('kode_jenis', $kode_jenis)->first();

        // Periksa apakah data mesin ditemukan
        if (!$mesin) {
            abort(404); // Munculkan halaman 404 jika data mesin tidak ditemukan
        }

        // URL untuk /qrcode/hasil/{kode_jenis}
        // $resultUrl = route('qrcode.result', ['kode_jenis' => $mesin->kode_jenis]);

        // Menyimpan URL dalam QR Code
        // $qrCode = QrCode::size(200)->generate($resultUrl);
        $qrCode = QrCode::size(200)->generate($mesin->kode_jenis);

        return view('qrcode.index', [
            'qrCode' => $qrCode, // Mengirim QR Code ke view
            'mesin' => $mesin, // Mengirim data mesin ke view
        ]);
    }

    public function showResult($kode_jenis)
    {
        $datamesin = DataMesin::where('kode_jenis', $kode_jenis)->first();
        return view('landingpublic.index', compact('datamesin'));
    }
    public function generateQRCode($code)
    {
        // Membuat QR Code berdasarkan kode yang didapat dari hasil scan
        $qrCode = QrCode::size(300)->generate($code);

        // Menampilkan QR Code dalam bentuk gambar
        return response($qrCode)->header('Content-type', 'image/png');
    }
}
