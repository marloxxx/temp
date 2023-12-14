<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pelaporan.feedback.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (Pelaporan::whereId($id)->exists()) {
            $pelaporanId = $id;
            $petugasId = Auth::user()->id;
            return view('pelaporan.feedback.create', compact('pelaporanId', 'petugasId'));
        }

        return redirect('/pelaporan/cek')->with('error', 'Data tidak ada!');
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
            'hasil_perbaikan'  => 'required',
            'uraian_perbaikan'  => 'required',
        ], [
            'hasil_perbaikan.required' => 'Tidak Boleh Kosong!',
            'uraian_perbaikan.required' => 'Form Tidak Boleh Kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        Feedback::create([
            'hasil_perbaikan' => $request->hasil_perbaikan,
            'uraian_perbaikan'=> $request->uraian_perbaikan,
            'pelaporan_id'=> $request->pelaporan_id,
            'petugas_id'=> $request->petugas_id,
        ]);

        $update_pelaporan_status = Pelaporan::findOrFail($request->pelaporan_id);
        $update_pelaporan_status->update(['status' => 'selesai']);

        return redirect('/pelaporan/cek')->with('success', 'Berhasil menambahkan feedback');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
