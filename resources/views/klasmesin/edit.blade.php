@extends('layout.main')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">
                Edit Klasifikasi
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
                <form method="post" action="/klasifikasi-mesin/{{$klasmesin->id}}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Klasifikasi</label>
                        <input type="text" name="nama_klasifikasi" class="form-control" id="nama" value="{{$klasmesin->nama_klasifikasi}}" aria-describedby="nama_klasifikasi">
                    </div><br>
                    <div class="form-group">
                        <label for="keterangan">Kode klasifikasi</label>
                        <input type="text" name="kode_klasifikasi" class="form-control" id="keterangan" value="{{$klasmesin->kode_klasifikasi}}" aria-describedby="kode_klasifikasi">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success " href="/klasifikasi-mesin">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection