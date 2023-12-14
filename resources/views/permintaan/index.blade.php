@extends('layout.main')
@section('title'){{'Permintaan'}} @endsection
@section('content')
<h1 class="h3 mb-2 text-gray-800">Daftar Permintaan Perbaikan</h1>
<p class="mb-4">Berikut Merupakan Daftar Permintaan Perbaikan</p>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2>Tambah Data Mesin</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="/data-mesin" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_jenis" class="form-label">Nomor</label>
                            <input type="text" name="kode_jenis" class="form-control @error('kode_jenis') is-invalid @enderror" id="kode_jenis" placeholder="Masukkan nama jenis baru.." maxlength="10" readonly value="{{ old('kode_jenis', sprintf('001-%s', old('tahun_mesin'))) }}">
                            @error('kode_jenis')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="nama_mesin" class="form-label">Nama Mesin<span class="text-danger">*</span></label>
                                <input type="text" name="nama_mesin" class="form-control" id="nama_mesin" placeholder="Masukkan Nama Mesin" value="{{ old('nama_mesin') }}" required>
                                @error('nama_mesin')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <input type="text" name="kapasitas" class="form-control" id="kapasitas" placeholder="Masukan Kapasitas Bulanan" value="{{ old('kapasitas') }}">
                                @error('kapasitas')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @endsection