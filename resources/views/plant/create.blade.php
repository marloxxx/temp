@extends('layout.main')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">Tambah Data Plant
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
                <form method="post" action="/plant" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_workshop">Nama Plant</label>
                        <input type="text" name="nama_plant" class="form-control" id="nama_plant" aria-describedby="nama_plant">
                    </div><br>
                    <!--
                    <div class="form-group">
                        <label for="image">Foto Kategori</label>
                        <input type="file" name="image" class="form-control" id="image" ariadescribedby="image">
                    </div><br>
                    -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success " href="/lokasi-workshop-mesin">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection