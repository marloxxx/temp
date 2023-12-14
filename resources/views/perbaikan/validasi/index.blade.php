@extends('layouts.template')
@section('title', 'Daftar Mesin')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">List Validasi Pengajuan Perbaikan</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
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
                            <table class="table table-bordered table-hover" id="dataTable-histori">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>Dari Tanggal</th>
                                        <th>Ke Tanggal</th>
                                        <th>Kerusakan</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($validasi as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->user->nama }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->pengajuan->dari_tanggal)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->pengajuan->ke_tanggal)) }}</td>
                                        <td>{{ $row->pengajuan->keterangan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#modal{{ $row->id }}">Validasi</button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal{{ $row->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Validasi Pengajuan</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('validasi.update', $row->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="name">Nama</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $row->user->nama }}" required readonly>
                                                        </div>

                                                        <div class="form-group form-row align-items-center">
                                                            <div class="col-lg-6">
                                                                <label for="dari_tanggal">Dari Tanggal</label>
                                                                <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" readonly value="{{ $row->pengajuan->dari_tanggal }}" required>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label for="ke_tanggal">Ke Tanggal</label>
                                                                <input type="date" class="form-control" id="ke_tanggal" name="ke_tanggal" value="{{ $row->pengajuan->ke_tanggal }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <textarea class="form-control" cols="10" rows="3" readonly>{{ $row->pengajuan->keterangan }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select name="status" id="status" class="form-control" required>
                                                                <option value="">- Pilih -</option>
                                                                <option value="S">Approve</option>
                                                                <option value="T">Reject</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="keterangan">Analisis Kerusakan</label>
                                                            <textarea name="keterangan" class="form-control" id="keterangan" cols="10" rows="3" required></textarea>
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
                                    @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center">Data tidak ditemukan</td>
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

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">List Histori Validasi Pengajuan</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>Dari Tanggal</th>
                                        <th>Ke Tanggal</th>
                                        <th>kerusakan</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($histori as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->user->nama }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->pengajuan->dari_tanggal)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->pengajuan->ke_tanggal)) }}</td>
                                        <td>{{ $row->pengajuan->keterangan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#modal{{ $row->id }}">Histori</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center">Data tidak ditemukan</td>
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

@foreach ($histori as $row)
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
                                @if ($row->action_to_do == 'R')
                                <span class="badge badge-warning">Pengajuan</span>
                                @elseif ($row->action_to_do == 'T')
                                <span class="badge badge-danger">Ditolak</span>
                                @else
                                <span class="badge badge-success">Diterima</span>
                                @endif
                            </td>
                            <td>{{ $his->keterangan }}</td>
                        </tr>
                        @endif
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@include('sweetalert::alert')
@endsection