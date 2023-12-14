@extends('layout.main')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">Tambah Data Peminjaman
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="/pinjam" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">Nama Peminjam</label>
                        <select class="form-select" name="anggotas_id">
                            @foreach ($data_anggotas as $anggota)
                            <option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="bukus_id    ">Nama Mesin</label>
                        <select class="form-select" name="bukus_id">
                            @foreach ($data_bukus as $buku)
                            <option value="{{ $buku->id }}">{{ $buku->no_mesin }} - {{ $buku->nama_mesin }}</option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam" ariadescribedby="tanggal">
                    </div><br>
                    <div class="form-group">
                        <label for="lama_peminjaman">Lama Peminjaman ( Hari )</label>
                        <input type="text" name="lama_peminjaman" class="form-control" id="lama_peminjaman" aria-describedby="lama_peminjaman">
                    </div><br>
                    <div class="form-group">
                        <label for="user_id">Petugas</label>
                        <input type="text" class="form-control" value="{{ auth() -> user() -> nama }}" readonly>
                        <input type="hidden" name="user_id" value="{{ auth() -> user() -> id }}">
                    </div><br>
                    <div class="form-group" @if(auth()->user()->level=='Admin')>
                        <label for="status">Status</label>

                        <select class="form-select" name="status">
                            <option value="2">Terkirim</option>
                        </select>
                    </div>
                    @else

                    @endif
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success " href="/pinjam">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection