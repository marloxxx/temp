@extends('layout.main')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">
                Edit Pegawai
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
                <form method="post" action="/pegawai/{{$data_anggotas->id}}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control" id="image" aria-describedby="Image">
                    </div><br>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik" value="{{ $data_anggotas->nik }}" aria-describedby="nik">
                    </div><br>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="Nama" value="{{ $data_anggotas->nama }}" aria-describedby="Nama">
                    </div><br>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" id="jabatan" value="{{ $data_anggotas->jabatan }}" aria-describedby="jabatan">
                    </div><br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success " href="/pegawai">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection