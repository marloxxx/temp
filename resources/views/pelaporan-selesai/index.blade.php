@extends('layout.main')
@section('title'){{'Data Pelaporan Selesai'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pelaporan Selesai</h1>
    <p class="mb-4">Berikut Merupakan Data Pelaporan Selesai</p>

    @if(Session::has('berhasil'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success,</strong>
        {{ Session::get('berhasil') }}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="/selesai/laporan/pdf" class="btn mb-3 btn-success btn-icon-split btn-sm">Print Data</a>
            <button class="btn mb-3 btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#cetakModal">
                Print Berdasarkan Tanggal
            </button>
        </div>

        <!-- Modal Cetak Laporan Berdasarkan Tanggal -->
        <div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cetakModalLabel">Cetak Laporan Berdasarkan Tanggal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk input tanggal -->
                        <form action="{{ route('cetak-laporan') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="tanggalAwal">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggalAwal" name="tanggalAwal" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggalAkhir">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggalAkhir" name="tanggalAkhir" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




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
                                    <th>Nama Pemohon</th>
                                    <th>Nama Barang</th>
                                    <th>Lokasi</th>
                                    <th>Tgl. Pelaporan</th>
                                    <th>Selesai Perbaikan</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelaporans as $pelaporan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pelaporan->no_registrasi }}</td>
                                    <td><span class="badge bg-success p-2">{{ $pelaporan->status }}</span></td>
                                    <td>{{ $pelaporan->user->nama }}</td>
                                    <td>{{ $pelaporan->datamesin->nama_mesin }}</td>
                                    <td>{{ $pelaporan->datamesin->workshop->nama_workshop }}</td>
                                    <td>{{ $pelaporan->created_at }}</td>
                                    <td>{{ $pelaporan->updated_at }}</td>
                                    <td>
                                        <a href="/pelaporan/selesai/cetak/{{ $pelaporan->id }}" class="btn btn-primary" target="_blank">Print</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <style>
                /* Custom styles for all modals */
                .modal {
                    background: rgba(0, 0, 0, 0.5);
                }

                .modal-content {
                    background-color: #ffffff;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                .modal-header {
                    background-color: #007bff;
                    color: #ffffff;
                    border-bottom: 1px solid #dee2e6;
                }

                .modal-title {
                    font-weight: bold;
                }

                .modal-body {
                    padding: 20px;
                }

                .modal-footer {
                    border-top: 1px solid #dee2e6;
                    padding: 15px;
                }

                .close {
                    font-size: 1.5rem;
                    font-weight: bold;
                    line-height: 1;
                    color: #00000;
                    opacity: 0.75;
                }

                #datatable1 th,
                #datatable1 td {
                    text-align: center;
                }

                #datatable1 th:nth-child(1),
                #datatable1 td:nth-child(1) {
                    width: 5%;
                    /* Adjust the width as needed */
                }

                #datatable1 th:nth-child(2),
                #datatable1 td:nth-child(2) {
                    width: 15%;
                    /* Adjust the width as needed */
                }

                #datatable1 th:nth-child(3),
                #datatable1 td:nth-child(3) {
                    width: 10%;
                    /* Adjust the width as needed */
                }

                #datatable1 th:nth-child(4),
                #datatable1 td:nth-child(4) {
                    width: 25%;
                    /* Adjust the width as needed */
                }

                #datatable1 th:nth-child(5),
                #datatable1 td:nth-child(5) {
                    width: 15%;
                    /* Adjust the width as needed */
                }

                #datatable1 th:nth-child(6),
                #datatable1 td:nth-child(6) {
                    width: 20%;
                    /* Adjust the width as needed */
                }

                #datatable1 th:nth-child(7),
                #datatable1 td:nth-child(7) {
                    width: 20%;
                    /* Adjust the width as needed */
                }

                #datatable1 th:nth-child(8),
                #datatable1 td:nth-child(8) {
                    width: 15%;
                    /* Adjust the width as needed */
                }
            </style>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>
            @include('sweetalert::alert')
            @endsection