<?php

namespace App\Http\Controllers\Analisis;

use App\Http\Controllers\Controller;
use App\Models\Analisis;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pelaporan.analisis.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $teknisi = Auth::user();
        $pelaporan = Pelaporan::where('id', $id)->first();
        return view('pelaporan.analisis.create', compact('teknisi', 'pelaporan'));
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
            'analisa' => 'required',
            'tindakan' => 'required',
            'saran' => 'required',
        ], [
            'analisa.required'   => 'Form wajib diisi !',
            'tindakan.required'    => 'Form wajib diisi !',
            'saran.required'    => 'Form wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // dd($request->pelaporan_id);
        // exit;
        Analisis::create([
            'pelaporan_id' => $request->pelaporan_id,
            'pemohon_id' => $request->pemohon_id,
            'petugas_id' => $request->petugas_id,
            'tanggal_analisa' => $request->tanggal_analisa,
            'analisa' => $request->analisa,
            'tindakan' => $request->tindakan,
            'saran' => $request->saran,
        ]);

        $update_pelaporan_status = Pelaporan::findOrFail($request->pelaporan_id);
        $update_pelaporan_status->update(['status' => 'menunggu feedback']);

        return redirect('/pelaporan/masuk')->with('success', 'Berhasil membuat analisa pelaporan');
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
