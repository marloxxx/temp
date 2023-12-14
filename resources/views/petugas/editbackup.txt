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
                <form method="post" action="/datapetugas/{{$users->id}}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group text-center mb-4">
                        <label for="foto">Foto Profil</label>
                        <div class="mb-2">
                            <img width="150px" src="{{ asset('storage/' . $users->foto) }}" alt="{{ $users->foto }}" class="img-thumbnail">
                        </div>
                        <input type="file" name="foto" class="form-control-file" id="foto" aria-describedby="foto">
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Petugas</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $users->nama }}" aria-describedby="nama">
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik" value="{{ $users->nik }}" aria-describedby="nik">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ $users->email }}" aria-describedby="email">
                    </div>

                    <div class="form-group">
                        <label for="lok_ws" class="form-label">Departemen<span class="text-danger">*</span></label>
                        <select class="form-select" name="lok_ws" data-placeholder="Silahkan Pilih" id="single-select-field1">
                            <option value="" selected disabled>-- Pilih Lokasi Terdaftar --</option>
                            @foreach ($departemen as $departemen)
                            <option value="{{ $departemen->nama_departemen }}">{{ $departemen->nama_departemen }}</option>
                            @endforeach
                        </select>
                        @error('lok_ws')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lok_ws" class="form-label">Plant<span class="text-danger">*</span></label>
                        <select class="form-select" name="lok_ws" data-placeholder="Silahkan Pilih" id="single-select-field2">
                            <option value="" selected disabled>-- Pilih Lokasi Terdaftar --</option>
                            @foreach ($plant as $dataplant)
                            <option value="{{ $dataplant->nama_plant }}">{{ $dataplant->nama_plant }}</option>
                            @endforeach
                        </select>
                        @error('lok_ws')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="password">
                    </div>

                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-select" name="level">
                            <option value="Admin" {{ $users->level == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Petugas" {{ $users->level == 'Petugas' ? 'selected' : '' }}>Petugas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_join">Tanggal Join</label>
                        <input type="date" name="tanggal_join" class="form-control" id="tanggal_join" value="{{ $users->tanggal_join }}" aria-describedby="tanggal_join">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-success" href="/datapetugas">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#single-select-field1').select2();
        $('#single-select-field2').select2();
    });
</script>
<style>
    /* Tambahkan gaya CSS kustom Anda di sini */
    body {
        background-color: #f8f9fa;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .img-thumbnail {
        max-width: 150px;
        max-height: 150px;
    }
</style>
@endsection