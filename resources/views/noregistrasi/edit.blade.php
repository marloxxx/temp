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
                <form method="post" action="/workshop/{{$workshop->id}}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Kategori</label>
                        <input type="text" name="nama_workshop" class="form-control" id="nama" value="{{$workshop->nama_workshop}}" aria-describedby="nama_workshop">
                    </div><br>
                    <div class="form-group">
                        <label for="keterangan">Deskripsi</label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan" value="{{$workshop->keterangan}}" aria-describedby="keterangan">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success " href="/workshop">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection