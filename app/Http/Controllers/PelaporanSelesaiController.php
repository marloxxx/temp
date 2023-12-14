<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\FeedbackReply;
use App\Models\Pelaporan;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class PelaporanSelesaiController extends Controller
{
    public function index()
    {
        return view('pelaporan-selesai.index', [
            'pelaporans'    => Pelaporan::where('status', 'selesai')->orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function cetakLaporan($id)
    {
        $pelaporan = Pelaporan::find($id);
        $feedback       = Feedback::where('pelaporan_id', $pelaporan->id)->first();
        $feedbackReply  = $feedback ? FeedbackReply::where('feedback_id', $feedback->id)->first() : null;


        $pdf = PDF::loadView('pelaporan-selesai.print', [
            'pelaporan'    => $pelaporan,
            'feedback'      => $feedback,
            'feedbackReply' => $feedbackReply
        ]);

        return $pdf->stream('cetak-laporan.pdf');
    }
    public function cetak_pdf()
    {
        $articles = Pelaporan::all();
        $pdf = PDF::loadview('pelaporan-selesai.list-laporan', ['pelaporans' => $articles]);
        return $pdf->stream();
    }

    public function cetakLaporanBerdasarkanTanggal(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'tanggalAwal' => 'required|date',
            'tanggalAkhir' => 'required|date|after_or_equal:tanggalAwal',
        ]);

        // Proses pencarian data berdasarkan tanggal
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');

        $dataLaporan = Pelaporan::whereBetween('tanggal_permintaan', [$tanggalAwal, $tanggalAkhir])
            ->where('status', 'selesai')
            ->orderBy('tanggal_permintaan', 'asc')
            ->get();

        // Cek apakah ada data
        if ($dataLaporan->isEmpty()) {
            return redirect()->route('index-laporan')->with('error', 'Tidak ada data laporan untuk periode tersebut.');
        }

        // Contoh generate PDF
        $pdf = PDF::loadView('pelaporan-selesai.list-laporan-tanggal', [
            'dataLaporan' => $dataLaporan,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ]);

        // Download PDF
        return $pdf->download('laporan-' . $tanggalAwal . '-sampai-' . $tanggalAkhir . '.pdf');
    }
}
