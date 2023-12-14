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
                    <form method="post" action="/data-mesin" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="nama_mesin" class="form-label">Nama Mesin<span class="text-danger">*</span></label>
                                <input type="text" name="nama_mesin" class="form-control" id="nama_mesin" placeholder="Masukkan Nama Mesin" value="{{ old('nama_mesin') }}" required>
                                @error('nama_mesin')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="tanggal_minta" class="form-label">Tanggal Permintaan<span class="text-danger">*</span></label>
                                <input type="date" name="kapasitas" class="form-control" id="tanggal1" placeholder="Masukan Tanggal Permintaan" value="{{ old('kapasitas') }}">
                                @error('tanggal_minta')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="nama_mesin" class="form-label">Workshop<span class="text-danger">*</span></label>
                                <input type="text" name="nama_mesin" class="form-control" id="nama_mesin" placeholder="Masukkan Nama Mesin" value="{{ old('nama_mesin') }}" required>
                                @error('nama_mesin')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="tanggal_minta" class="form-label">Tanggal & Waktu Terjadi Kerusakan<span class="text-danger">*</span></label>
                                <input type="date" name="kapasitas" class="form-control" id="tanggal" placeholder="Masukan Tanggal Permintaan" value="{{ old('kapasitas') }}" readonly>
                                @error('tanggal_minta')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama_mesin" class="form-label">Nama Alat/Mesin<span class="text-danger">*</span></label>
                            <input type="text" name="nama_mesin" class="form-control" id="nama_mesin" placeholder="Masukkan Nama Mesin" value="{{ old('nama_mesin') }}" required>
                            @error('nama_mesin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_mesin" class="form-label">Uraian kerusakan<span class="text-danger">*</span></label>
                            <input type="text" name="nama_mesin" class="form-control" id="nama_mesin" placeholder="Masukkan Nama Mesin" value="{{ old('nama_mesin') }}" required>
                            @error('nama_mesin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a class="btn btn-success" href="#">Kembali</a>
                        </div>
                    </form>
                </div>
                <script>
                    // Ambil elemen input tanggal
                    var tanggalInput = document.getElementById('tanggal');

                    // Buat objek Date untuk mendapatkan tanggal hari ini
                    var today = new Date();

                    // Format tanggal menjadi YYYY-MM-DD
                    var formattedDate = today.toISOString().split('T')[0];

                    // Set nilai input tanggal dengan tanggal hari ini
                    tanggalInput.value = formattedDate;
                </script>
                @endsection