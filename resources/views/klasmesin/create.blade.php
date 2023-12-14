@extends('layout.main')
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">Tambah Data Klasifikasi
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
                <form method="post" action="/klasifikasi-mesin" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kategori" class="form-label">Kategori Mesin<span class="text-danger">*</label>
                        <select id="single-select-field" name="kategorimesin_id" class="form-control" required>
                            <option value="">-- Select Kategori --</option>
                            @foreach ($kategorimesin as $data)
                            <option value="{{ $data->id }}" data-kode-kategori="{{ $data->kode_kategori }}">{{ $data->nama_kategori }}</option>
                            </option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label for="nama_workshop">Nama Klasifikasi</label>
                        <input type="text" name="nama_klasifikasi" class="form-control" id="nama_klasifikasi" aria-describedby="nama_worksop">
                    </div><br>
                    <div class="form-group">
                        <label for="keterangan">Kode klasifikasi</label>
                        <input type="text" name="kode_klasifikasi" class="form-control" id="keterangan" ariadescribedby="keterangan">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success " href="/klasifikasi-mesin">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#single-select-field').select2();
    });
</script>
@endsection