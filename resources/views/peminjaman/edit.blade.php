@extends('layout.main')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">
                Edit Data Buku
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
                <form method="post" action="/pinjam/{{$peminjamans->id}}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="anggotas_id">Nama Peminjam</label>
                        <select class="form-select" name="anggotas_id">
                            @foreach ($data_anggotas as $anggota)
                            <option value="{{ $anggota->id }}" @if($anggota->id==$peminjamans->anggotas_id) selected @endif>
                                {{ $anggota->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="image">Nama Buku</label>
                        <select class="form-select" name="bukus_id">
                            @foreach ($data_bukus as $buku)

                            <option value="{{ $buku->id }}" @if($buku->id==$peminjamans->bukus_id) selected @endif>
                                {{ $buku->judul_buku }}
                            </option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="book_image">Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam" value="{{$peminjamans->tanggal_pinjam}}" aria-describedby="tanggal_pinjam">
                    </div><br>
                    <div class="form-group">
                        <label for="lama_peminjaman">Lama Peminjaman</label>
                        <input type="text" name="lama_peminjaman" class="form-control" id="lama_peminjaman" value="{{$peminjamans->lama_peminjaman}}" aria-describedby="lama_peminjaman">
                    </div><br>
                    <div class="form-group">
                        <label for="penerbit">Petugas</label>
                        <input type="text" name="user_id" class="form-control" value="{{$peminjamans->user->nama}}" readonly>
                    </div><br>
                    <div class="form-group" @if(auth()->user()->level=='Admin')>
                        <label for="status">Status</label>

                        <select class="form-select" name="status">
                            <option value="2">Terkirim</option>
                            <option value="2">Diterima</option>
                            <option value="2">Ditolak</option>
                        </select>
                    </div>
                    @else

                    @endif
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success " href="/transaksipeminjaman">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection