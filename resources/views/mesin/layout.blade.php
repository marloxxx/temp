@extends('layout.main')
@section('title', 'Daftar Mesin')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Mesin</h1>
    <p class="mb-4">Berikut merupakan data Mesin di Maintenance</p>

    @if(Session::has('berhasil'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success,</strong>
        {{ Session::get('berhasil') }}
    </div>
    @endif

    <a href="/data-mesin/create" class="btn btn-primary btn-icon-split btn-sm mb-3">Tambah Data Mesin</a>
    <a href="/data-mesin/printpdf" class="btn btn-success btn-icon-split btn-sm mb-3">Print Data Mesin</a>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th style="width: 10%;">No.Registrasi</th>
                    <th style="width: 10%;">Klasifikasi Mesin</th>
                    <th style="width: 15%;">Nama Mesin</th>
                    <th style="width: 7%;">Type</th>
                    <th style="width: 7%;">Merk</th>
                    <th style="width: 15%;">Spesifikasi</th>
                    <th style="width: 8%;">Lokasi</th>
                    <th style="width: 8%;">Pabrikan</th>
                    <th style="width: 5%;">Kapasitas</th>
                    <th style="width: 5%;">Tahun Lokasi</th>
                    <th style="width: 10%;">Ubah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($post as $mesin)
                <tr>
                    <td>{{$mesin->no_mesin}}</td>
                    <td>{{$mesin->klas_mesin}}</td>
                    <td class="text-capitalize">{{$mesin->nama_mesin}}</td>
                    <td>Min. {{$mesin->spek_min}} - Max. {{$mesin->spek_max}}</td>
                    <td>{{$mesin->lok_ws}}</td>
                    <td>{{$mesin->type_mesin}}</td>
                    <td>{{$mesin->merk_mesin}}</td>
                    <td>{{$mesin->pabrik}}</td>
                    <td><span>{{ $mesin->kapasitas }} (Ton)</span></td>
                    <td>{{$mesin->tahun_mesin}}</td>
                    <td>
                        <a class="btn btn-info" href="/data-mesin/{{$mesin->id}}"><i class="bi bi-eye"></i></a>
                        <a class="btn btn-primary" href="/data-mesin/{{$mesin->type_mesin}}/edit"><i class="bi bi-pencil-square"></i></a>
                        <div style="display: flex; align-items: center;">
                            <form action="/data-mesin/{{$mesin->id}}" method="POST" style="margin-right: 10px;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini? ')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                            <a class="btn btn-info" href="/qrcode/{{$mesin->type_mesin}}" style="display: inline-block; padding: 5px; background-color: #ECEE81; margin-left: -6px; ">
                                <img src="{{ asset('assets/icon/qrcode-solid.svg') }}" alt="Lihat" style="width: 34px; height: 27px;">
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{$post->links()}}
    </div>
</div>
@endsection