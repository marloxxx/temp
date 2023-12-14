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
                <form method="post" action="/datakategori/{{$data_kategoris->id}}" id="myForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="form-group">
                        <label for="nama">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" id="nama" value="{{$data_kategoris->nama_kategori}}"
                            aria-describedby="nama_kategori">
                    </div><br>
                <div class="form-group">
                        <label for="image">Foto Kategori</label>
                        <input type="file" name="image" class="form-control" id="image" aria-describedby="image">
                            <value="{{ $data_kategoris -> image }}">
                        <img width="150px" src="{{asset('storage/'.$data_kategoris -> image)}}"
                            alt="{{$data_kategoris->image}}">
                    </div><br>    
                <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{$data_kategoris->deskripsi}}"
                            aria-describedby="deskripsi">
                    </div><br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-success " href="/datakategori">Kembali</a>
            </form>
        </div>
    </div>
</div>
</div>
@endsection