@extends('layout.main')
@section('title'){{'Data Pelaporan Masuk'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pelaporan Masuk</h1>
    <p class="mb-4">Berikut Merupakan Data Pelaporan Masuk</p>

    @if(Session::has('berhasil'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success,</strong>
        {{ Session::get('berhasil') }}
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row px-3 py-3">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="datatable1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Registrasi</th>
                                    <th>Status</th>
                                    <th>Nama Mesin</th>
                                    <th>Lokasi</th>
                                    <th>Lihat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelaporans as $pelaporan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pelaporan->no_registrasi }}</td>
                                        <td>
                                            @if ($pelaporan->status == 'menunggu')
                                                <span class="badge bg-warning m-2">{{ $pelaporan->status }}</span>
                                            @elseif($pelaporan->status == 'sedang diperbaiki')
                                                <span class="badge bg-primary m-2">{{ $pelaporan->status }}</span>
                                            @elseif($pelaporan->status == 'selesai')
                                                <span class="badge bg-success m-2">{{ $pelaporan->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $pelaporan->datamesin->nama_mesin }}</td>
                                        <td>{{ $pelaporan->datamesin->workshop->nama_workshop }}</td>
                                        <td>
                                            <a href="/pelaporan/masuk/detail/{{ $pelaporan->id }}"
                                                class="btn btn-success">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
            </div>
        </div>
        @include('sweetalert::alert')
        @endsection
