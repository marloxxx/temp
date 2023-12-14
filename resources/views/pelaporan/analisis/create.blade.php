@extends('layout.main')
@section('title'){{'Buat Analisis'}} @endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2>Form Analisis</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="/pelaporan/analisis/store" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="pelaporan_id" value="{{ $pelaporan->id }}" hidden readonly>
                        <input type="text" name="pemohon_id" value="{{ $pelaporan->id_pemohon }}" hidden readonly>
                        <input type="text" name="petugas_id" value="{{ $teknisi->id }}" hidden readonly>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Teknisi yang Memperbaiki:<span class="text-danger">*</span></label>
                            <input type="text" name="nama_teknisi" class="form-control" id="nama" placeholder="Masukkan Nama Mesin" value="{{ $teknisi->nama }}" readonly>
                            @error('nama_mesin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_minta" class="form-label">Tanggal<span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_analisa" class="form-control" id="tanggal" placeholder="Masukan Tanggal Permintaan" value="" readonly>
                            @error('tanggal_minta')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_mesin" class="form-label">Analisa Penyebab Kerusakan<span class="text-danger">*</span></label>
                            <textarea type="text" name="analisa" class="form-control" id="nama_mesin" placeholder="Masukkan Analisa" value="" rows="4" required></textarea>
                            @error('nama_mesin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_mesin" class="form-label">Tindakan Perbaikan<span class="text-danger">*</span></label>
                            <input type="text" name="tindakan" class="form-control" id="nama_mesin" placeholder="Masukkan Tindakan Perbaikan" value="" required>
                            @error('nama_mesin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_mesin" class="form-label">saran-saran Tindakkan Untuk pencegahan agar tidak terjadi Rusak kembali<span class="text-danger">*</span></label>
                            <textarea type="text" name="saran" class="form-control" id="nama_mesin" placeholder="Masukkan saran" value="" rows="4" required></textarea>
                            @error('nama_mesin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama_mesin" class="form-label">Uraian kerusakan<span class="text-danger">*</span></label>
                            <input type="text" name="uraian" class="form-control" id="nama_mesin" placeholder="Masukkan Uraian" value="{{ $pelaporan->deskripsi }}" readonly>
                            @error('nama_mesin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a class="btn btn-success" href="/pelaporan/masuk/detail/{{ $pelaporan->id }}">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Mendapatkan elemen input tanggal berdasarkan ID
    var inputTanggal = document.getElementById('tanggal');

    // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
    var today = new Date().toISOString().split('T')[0];

    // Mengisi nilai input tanggal dengan tanggal hari ini
    inputTanggal.value = today;
</script>
@endsection