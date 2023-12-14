@extends('layout.main')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">
                Edit Kategori
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
                <form method="post" action="/kategori-mesin/{{$kategori->id}}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" id="nama" value="{{$kategori->nama_kategori}}" aria-describedby="nama_katgeori">
                    </div><br>
                    <div class="form-group">
                        <label for="keterangan">Deskripsi</label>
                        <input type="text" name="kode_kategori" class="form-control" id="keterangan" value="{{$kategori->kode_kategori}}" aria-describedby="kode_kategori">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success " href="/kategori-mesin">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection