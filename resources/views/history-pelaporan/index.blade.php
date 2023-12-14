@extends('layout.main')
@section('title'){{'Cek Pelaporan'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">History Pelaporan</h1>
    <p class="mb-4">Berikut Merupakan Data History Pelaporan</p>

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
                                    <th>Opsi</th>
                                    <th>No</th>
                                    <th>No Registrasi</th>
                                    <th>Status</th>
                                    <th>Nama Mesin</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Tanggal & Waktu Kerusakan</th>
                                    <th>Uraian Kerusakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @dd($data);

                                {{-- @foreach ($pelaporans as $pelaporan)
                                    <tr>
                                        <td>
                                            <a class="btn btn-info" href="/pelaporan/cek/detail/{{ $pelaporan->id }}"><i class="bi bi-eye"></i></a>
                                            <a class="btn btn-info" href="/laporan/pdf/{{ $pelaporan->id }}"><i class="fa-solid fa-file"></i> PDF</a>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pelaporan->no_registrasi }}</td>
                                        <td>
                                            @if ($pelaporan->status == 'menunggu')
                                                <span class="badge bg-warning p-2">{{ $pelaporan->status }}</span>
                                            @elseif($pelaporan->status == 'sedang diperbaiki')
                                                <span class="badge bg-primary p-2">{{ $pelaporan->status }}</span>
                                            @elseif($pelaporan->status == 'selesai')
                                                <span class="badge bg-success p-2">{{ $pelaporan->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $pelaporan->datamesin->nama_mesin }}</td>
                                        <td>{{ $pelaporan->datamesin->workshop->nama_workshop }}</td>
                                        <td>{{ $pelaporan->tanggal_permintaan }}</td>
                                        <td>{{ $pelaporan->tanggal_kerusakan }}</td>
                                        <td>{{ $pelaporan->deskripsi }}</td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
            </div>
        </div>
        @include('sweetalert::alert')
        <style>
            /* Style for the table */
            .table.table-bordered thead th {
                text-align: center;
                vertical-align: middle;
                white-space: nowrap;
            }

            .table.table-bordered tbody td {
                text-align: center;
                vertical-align: middle;
                white-space: nowrap;
            }

            /* Adjust column widths */
            .table.table-bordered th:nth-child(1),
            .table.table-bordered td:nth-child(1) {
                width: 10%;
            }

            .table.table-bordered th:nth-child(2),
            .table.table-bordered td:nth-child(2) {
                width: 10%;
            }
        </style>
        @endsection
