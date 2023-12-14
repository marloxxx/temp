@extends('layout.main')
@section('title'){{'Buat Permintaan'}} @endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2>Form Perbaikkan</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="/pelaporan/tambah/store" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="noregistrasi" class="form-label">No. Registrasi:<span class="text-danger">*</span></label>
                            <input type="text" name="registrasi" class="form-control" id="registrasi" value="{{ $registrasi }}" readonly>
                            @error('registrasi')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <input type="text" name="id_pemohon" value="{{ $pemohon->id }}" hidden readonly>
                            <div class="col">
                                <label for="nama_pemohon" class="form-label">Nama Pemohon<span class="text-danger">*</span></label>
                                <input type="text" name="nama_pemohon" class="form-control" id="nama_pemohon" placeholder="Masukkan Nama Mesin" value="{{ $pemohon->nama }}" readonly>
                                @error('nama_pemohon')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class=" col">
                                <label for="tanggal_minta" class="form-label">Tanggal Permintaan<span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_permintaan" class="form-control" id="tanggal2" placeholder="Masukan Tanggal Permintaan" readonly>
                                @error('tanggal_minta')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_minta" class="form-label">Tanggal & Waktu Terjadi Kerusakan<span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tanggal_kerusakan" class="form-control" id="tanggal3" placeholder="Masukan Tanggal Terjadi Kerusakan">
                            @error('tanggal_minta')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="nama_mesin" class="form-label">Nama Alat/Mesin<span class="text-danger">*</span></label>
                                <input type="text" name="nama_mesin" class="form-control" id="nama_mesin" value="{{ $namaMesin }}" required readonly>
                                @error('nama_mesin')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="nama_mesin" class="form-label">Gambar<span class="text-danger">*</span></label>
                                <input type="file" name="gambar" class="form-control" id="nama_mesin" value="" required>
                                @error('nama_mesin')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_mesin" class="form-label">Uraian kerusakan<span class="text-danger">*</span></label>
                            <textarea type="text" name="deskripsi" class="form-control" id="nama_mesin" placeholder="Deskripsikan Urian Kerusakan" value="{{ old('nama_mesin') }}" rows="7">{{ old('nama_mesin') }}</textarea>
                            @error('nama_mesin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="text" name="id_mesin" class="form-control" id="id_mesin" value="{{ $idMesin }}" required readonly hidden>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a class="btn btn-success" href="/pelaporan/tambah">Kembali</a>
                        </div>
                    </form>
                </div>
                <script>
                    // Mendapatkan elemen input tanggal berdasarkan ID
                    var inputTanggal = document.getElementById('tanggal2');

                    // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
                    var today = new Date().toISOString().split('T')[0];

                    // Mengisi nilai input tanggal dengan tanggal hari ini
                    inputTanggal.value = today;
                </script>
                <script>
                    // Mengatur tanggal dan waktu default ke waktu saat ini
                    document.getElementById('tanggal3').valueAsDate = new Date();
                </script>
                @endsection