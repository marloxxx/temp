@extends('layout.main')
@section('title', 'Daftar Mesin')
@section('content')
<!-- App css -->
<link href="{{ url('backend/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('backend/css/theme.min.css') }}" rel="stylesheet" type="text/css" />
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">List Pengajuan Perbaikan</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal">Tambah</button>
                    </div>

                    <div class="card-body">

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6><i class="icon fas fa-check"></i> {{ session('success') }}</h6>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6><i class="icon fas fa-times"></i> {{ session('error') }}</h6>
                        </div>
                        @endif

                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Pemohon</th>
                                        <th>Workshop</th>
                                        <th>Nama Alat/Mesin/K3</th>
                                        <th>Permintaan Selesai diperbaiki </th>
                                        <th>Kerusakan</th>
                                        <th>Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengajuan as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->dari_tanggal)) }}</td>
                                        <td>{{ $row->user->nama }}</td>
                                        <td>{{ $row->nama_ws }}</td>
                                        <td>{{ $row->keterangan }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td>
                                            @if ($row->st_pengajuan == 'R')
                                            <span class="badge badge-warning">Pengajuan</span>
                                            @elseif ($row->st_pengajuan == 'T')
                                            <span class="badge badge-danger">Ditolak</span>
                                            @else
                                            <span class="badge badge-success">Diterima</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#modal{{ $row->id }}">Histori</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center">Data tidak ditemukan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($pengajuan as $row)
<div class="modal fade" id="modal{{ $row->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Histori Pengajuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Analisis Kerusakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histori as $his)
                        @if ($his->pengajuan_id == $row->id)
                        <tr>
                            <td>
                                @if ($row->st_pengajuan == 'R')
                                <span class="badge badge-warning">Pengajuan</span>
                                @elseif ($row->st_pengajuan == 'T')
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-success">Diterima</span>
                                @endif
                            </td>
                            <td>{{ $his->keterangan }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>

                <!-- Tombol untuk Membuka Modal Feedback -->
                @if (!empty($histori->where('pengajuan_id', $row->id)->first()->keterangan))
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#feedbackModal{{ $row->id }}">
                    Berikan Feedback
                </button>
                @else
                <button class="btn btn-primary" type="button" disabled>
                    Berikan Feedback
                </button>
                @endif

                <!-- Modal Feedback -->
                <div class="modal fade" id="feedbackModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel{{ $row->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="feedbackModalLabel{{ $row->id }}">Berikan Feedback</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Isi Modal Feedback (Keterangan) -->
                                <textarea class="form-control" rows="4" placeholder="Isi keterangan atau pesan feedback Anda di sini..."></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <!-- Tombol untuk Mengirim Feedback (Anda dapat menambahkan aksi di sini) -->
                                <button type="button" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pengajuan Perbaikan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengajuan.store') }}" method="POST">
                    @csrf
                    <!--
                    <div class="form-group">
                        <label for="dari_tanggal">Dari Tanggal</label>
                        <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" required>
                    </div>

                    <div class="form-group">
                        <label for="ke_tanggal">Ke Tanggal</label>
                        <input type="date" class="form-control" id="ke_tanggal" name="ke_tanggal" required>
                    </div>

                    <div class="form-group">
                        <label for="ke_tanggal">Kerusakan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan" cols="10" rows="3"></textarea>
                    </div>
-->

                    <div class="form-group">
                        <label for="dari_tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="ke_tanggal">Nama pemohon</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" value="{{ auth()->check() ? auth()->user()->nama : '' }}" required disabled>
                    </div>

                    <div class="form-group">
                        <label for="ke_tanggal">Workshop</label>
                        <input type="text" class="form-control" id="nama_ws" name="nama_ws" required>
                    </div>

                    <div class="form-group">
                        <label for="ke_tanggal">Nama Alat/Mesin/K3</label>
                        <input type="text" class="form-control" id="ke_tanggal" name="ke_tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="ke_tanggal">Kerusakan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan" cols="10" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ke_tanggal">Permintaan Selesai diperbaiki</label>
                        <input type="text" class="form-control" id="nama_alatmesink3" name="nama_alatmesink3" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- jQuery  -->
<script src="{{ url('backend/js/jquery.min.js') }}"></script>
<script src="{{ url('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('backend/js/metismenu.min.js') }}"></script>
<script src="{{ url('backend/js/waves.js') }}"></script>
<script src="{{ url('backend/js/simplebar.min.js') }}"></script>

<script src="{{ url('backend/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('backend/datatables/dataTables.bootstrap4.js') }}"></script>

<!-- App js -->
<script src="{{ url('backend/js/theme.js') }}"></script>

<script>
    $(function() {
        $("#dataTable").DataTable({
            "responsive": true,
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            "drawCallback": function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });

        $("#dataTable-histori").DataTable({
            "responsive": true,
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            "drawCallback": function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });
    })
</script>
@include('sweetalert::alert')
@endsection