@extends('layout.main')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">Data Pengembalian
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
                
                <form method="post" action="/pengembalian" id="myForm" enctype="multipart/form-data">
                    @csrf
                   <div class="form-group">
                        <label for="anggota_id">Nama Peminjam</label>
                        <input type="text" value="{{$pengembalians->anggota->nama}}" class="form-control" id="anggota_id""
                        ariadescribedby="anggota_id" readonly>
                    </div><br>
                      <div class="form-group">
                        <label for="bukus_id">Nama Buku</label>
                        <input type="text" value="{{$pengembalians->buku->judul_buku}}" class="form-control" id="anggota_id""
                        ariadescribedby="anggota_id" readonly>
                    </div><br>
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Peminjaman</label>
                        <input type="date" value="{{$pengembalians->tanggal_pinjam}}" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam"
                            ariadescribedby="tanggal">
                    </div><br>
                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Pengembalian</label>
                        <input type="date" name="tanggal_kembali" class="form-control" id="tanggal_kembali"
                            ariadescribedby="tanggal_kembali">
                    </div><br>
                      <div class="form-group">
                        <label for="user_id">Petugas</label>
                        <input type="text" class="form-control" value="{{ auth() -> user() -> nama }}" readonly >
                        <input type="hidden" value="{{$pengembalians->id}}" name="peminjaman_id" id="">
                    </div><br>
                    <div class="form-group">
                        <label for="status">Status</label>
                         <select class="form-select" name="status">
                            <option value="1">Dipinjam</option>
                            <option value="2">Dikembalikan</option>
                          </select>
                    </div>
                    <br>                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success " href="/transaksipeminjaman">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection