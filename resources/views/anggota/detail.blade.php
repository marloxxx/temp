@extends('layout.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Detail Pegawai</h4>
                </div>
                <div class="card-body text-align">
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/'.$data_anggotas->image) }}" alt="Foto Pegawai" class="rounded img-variant" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-primary">ID</td>
                                <td>{{$data_anggotas->id}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">NIK</td>
                                <td>{{$data_anggotas->nik}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Nama</td>
                                <td>{{$data_anggotas->nama}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Jabatan</td>
                                <td>{{$data_anggotas->jabatan}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="/pegawai" class="btn btn-primary btn-block">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .img-variant {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s;
    }

    .img-variant:hover {
        transform: scale(1.1);
    }
</style>
@endsection