@extends('layout.main')
@section('title'){{'Permintaan'}} @endsection
@section('content')
<h1 class="h3 mb-2 text-gray-800">Daftar Permintaan Perbaikan</h1>
<p class="mb-4">Berikut Merupakan Daftar Permintaan Perbaikan</p>
<div class="row px-3 py-3">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="datatable">
                <thead>
                    <tr>
                        <th>fe</th>
                        <th>Id</th>
                        <th>No.Registrasi
                        <th>Nama Pemohon</th>
                        <th>Nama Alat/Mesin</th>
                        <th>Departemen</th>
                        <th>Tanggal permintaan</th>
                        <th>tanggal Kerusakan</th>
                        <th>Uraian Kerusakan</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($post as $data)
                    <tr>
                        <td>
                            <a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a>
                            <a class="btn btn-info" href="/laporan/pdf/{id}" style="width: 42px; padding: 7px;"><i class="fa-solid fa-file"></i> PDF</a>
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->reg_mesin }}</td>
                        <td>{{$data->nama_pemohon}}</td>
                        <td>{{$data->nama_mesin}}</td>
                        <td>{{$data->workshop}}</td>
                        <td>{{$data->tanggal_minta}}</td>
                        <td>{{$data->tanggal_terjadi}}</td>
                        <td>{{$data->uraian}}</td>
                        <td>
                    </tr>
                    @endforeach
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