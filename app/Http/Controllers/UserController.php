<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Models\Departemen;
use App\Models\Plant;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Workshop;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = $petugas = DB::table('users')->get();

        $post = User::orderBy('nama', 'asc')->paginate(10);
        return view('petugas.index', [
            'users' => $petugas,
            'post' => User::orderBy('nama', 'asc')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.create', [
            'users' => User::all(),
            'plant' => Plant::all(),
            'departemen' => Departemen::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = $request->validate([
            /*
            'foto' => 'required',
            */
            'nama' => 'required',
            'email' => '',
            'nik' => 'required',
            'departemen' => '',
            'plant' => '',
            'password' => '',
            'approved' => '',
            'level' => 'required',
            'tanggal_join' => '',

        ]);

        // Menggunakan Hash::make untuk menghash password
        $cek['password'] = Hash::make($request->input('password'));

        if ($request->file('foto')) {
            $cek['foto'] = $request->file('foto')->store('users', 'public');
        }
        User::create($cek);
        return redirect('/datapetugas')
            ->with('success', 'Petugas Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cek = User::where('id', $id)->first();
        return view('petugas.detail', [
            'users' => $cek,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nama)
    {
        $cek = User::where('nama', $nama)->first();
        return view('petugas.edit', [
            'users' => $cek,
            'plant' => Plant::all(),
            'departemen' => Departemen::all(),
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
            /*
        'foto' => 'required',
        */
            'nama' => 'required',
            'email' => '',
            'password' => 'nullable|min:6', // Kata sandi menjadi opsional dan minimal 6 karakter
            'level' => 'required',
            'plant' => '',
            'departemen' => '',
            'approved' => '',
            'tanggal_join' => '',
        ];

        $validatedData = $request->validate($rules);

        // Periksa apakah ada kata sandi baru yang dimasukkan
        if ($request->has('password')) {
            // Menggunakan Hash::make untuk menghash kata sandi baru
            $validatedData['password'] = Hash::make($request->input('password'));
        }

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['foto'] = $request->file('foto')->store('users', 'public');
        }

        User::where('id', $id)->update($validatedData);

        return redirect('/datapetugas')->with('success', 'Petugas berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/datapetugas')->with('success', 'Petugas berhasil di hapus!');
    }

    public function cetak_pdf()
    {
        $articles = User::all();
        $pdf = PDF::loadview('petugas.pdf', ['users' => $articles]);
        return $pdf->stream();
    }
    public function getData()
    {
        $users = User::select(['id', 'name', 'email', 'created_at']);

        return DataTables::of($users)
            ->addColumn('action', function ($user) {
                return '<button class="btn btn-sm btn-info">View</button>';
            })
            ->make(true);
    }
    public function approve(User $user)
    {
        // Lakukan logika approval disini
        $user->update(['approved' => 1]);

        return redirect()->route('users.index')->with('success', 'Penguna berhasil di approved');
    }
    public function unapprove(User $user)
    {
        // Lakukan logika unapproval disini
        $user->update(['approved' => 0]);

        return redirect()->route('users.index')->with('success', 'Penguna berhasil di unapproved');
    }
    public function export()
    {
        return Excel::download(new UserExport, 'User.xlsx');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new UserImport, request()->file('file'));

        return back()->with('success', 'Data imported successfully!');
    }
    public function reset()
    {
        // Hapus semua data departemen
        User::truncate();
        return redirect()->route('plant.index')->with('success', 'Data plant berhasil di-reset.');
    }
}
