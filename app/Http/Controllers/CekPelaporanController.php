<?php

namespace App\Http\Controllers;

use App\Models\Analisis;
use App\Models\Feedback;
use App\Models\FeedbackReply;
use App\Models\Pelaporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CekPelaporanController extends Controller
{
    public function index()
    {
        return view('cek-pelaporan.index', [
            'pelaporans' => Pelaporan::orderBy('id', 'DESC')->get()
        ]);
    }

    public function cekPelaporan($id)
    {
        return view('cek-pelaporan.index', [
            'pelaporans' => Pelaporan::orderBy('id', 'DESC')->where('datamesin_id', $id)->get()
        ]);
    }

    public function detail($id)
    {
        $pelaporan      = Pelaporan::find($id);
        $nama_pemohon   = User::where('id', $pelaporan->id_pemohon)->first();
        $feedback       = Feedback::where('pelaporan_id', $pelaporan->id)->first();
        $feedbackReply  = $feedback ? FeedbackReply::where('feedback_id', $feedback->id)->first() : null;
        $qrCode = QrCode::size(200)->generate($pelaporan->datamesin->kode_jenis);

        if (Analisis::whereId($id)) {
        }
        $analisis = Analisis::where('pelaporan_id', $pelaporan->id)->first();
        $analisa_perbaikan = $analisis ? $analisis->analisa : $pelaporan->status;
        $tanggal_perbaikan = $analisis ? $analisis->created_at : $pelaporan->status;

        $history = Pelaporan::where('datamesin_id', $pelaporan->datamesin_id)->get();

        return view('cek-pelaporan.detail', [
            'pelaporan'     => $pelaporan,
            'feedback'      => $feedback,
            'feedbackReply' => $feedbackReply,
            'qrCode'        => $qrCode,
            'history'       => $history,
            'nama_pemohon'  => $nama_pemohon->nama,
            'analisi_perbaikan' => $analisa_perbaikan,
            'tanggal_perbaikan' => $tanggal_perbaikan,
        ]);
    }

    public function store(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $validator = Validator::make($request->all(), [
            'feedback_replies'  => 'required'
        ], [
            'feedback_replies.required' => 'Form Tidak Boleh Kosong '
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        FeedbackReply::create([
            'feedback_id'       => $feedback->id,
            'feedback_replies'  => $request->feedback_replies,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan feedback baru');
    }
}
