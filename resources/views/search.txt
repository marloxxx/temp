@extends('layout.main')
@section('title', 'Hasil Pencarian Mesin')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Hasil Pencarian Mesin</h1>
    <p class="mb-4">Berikut merupakan hasil pencarian mesin di Maintenance</p>

    @if(count($results) > 0)

    <div class="row justify-content-start">
        <div class="col-6">
            <a href="/data-mesin/create" class="btn btn-primary btn-icon-split btn-sm mb-3">Tambah Data Mesin</a>
            <!--
            <a href="/data-mesin/printpdf" class="btn btn-success btn-icon-split btn-sm mb-3">Print Data Mesin</a>
            -->

            <a href="/file-import-export" class="btn btn-success btn-icon-split btn-sm mb-3">Import</a>
            <!--
            <a href="{{ route('file-export') }}" class="btn btn-success btn-icon-split btn-sm mb-3">Export</a>
            -->
            <div class="btn-group">
                <button class="btn btn-success btn-icon-split btn-sm mb-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Export
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">PDF</a></li>
                    <li><a class="dropdown-item" href="{{ route('file-export') }}">EXCEL</a></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Ubah</th>
                    <th>No.Registrasi</th>
                    <th>Katgeori Mesin</th>
                    <th>Klasifikasi Mesin</th>
                    <th>Nama Mesin</th>
                    <th>Type</th>
                    <th>Merk</th>
                    <th>Spesifikasi</th>
                    <th>Pabrikan</th>
                    <th>Kapasitas</th>
                    <th>Tahun Mesin</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $mesin)
                <tr>
                    <td>
                        <a class="btn btn-info" href="/data-mesin/{{ $mesin->id }}"><i class="bi bi-eye"></i></a>
                        <a class="btn btn-primary" href="/data-mesin/{{ $mesin->id }}/edit"><i class="bi bi-pencil-square"></i></a>
                        <div style="display: flex; align-items: center;">
                            <form action="/data-mesin/{{ $mesin->id }}" method="POST" style="margin-right: 10px;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini? ')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                            <a class="btn btn-info" href="/qrcode/{{ $mesin->type_mesin }}" style="display: inline-block; padding: 5px; background-color: #ECEE81; margin-left: -6px; ">
                                <img src="{{ asset('assets/icon/qrcode-solid.svg') }}" alt="Lihat" style="width: 34px; height: 27px;">
                            </a>
                        </div>
                    </td>
                    <td>{{ $mesin->kode_jenis }}</td>
                    <td>{{ $mesin->nama_kategori }}</td>
                    <td>{{ $mesin->klas_mesin }}</td>
                    <td class="text-capitalize">{{ $mesin->nama_mesin }}</td>
                    <td>{{ $mesin->type_mesin }}</td>
                    <td>{{ $mesin->merk_mesin }}</td>
                    <td>Min. {{ $mesin->spek_min }} - Max. {{ $mesin->spek_max }}</td>
                    <td>{{ $mesin->pabrik }}</td>
                    <td><span style="text-align:center;">{{ $mesin->kapasitas }} (Ton)</span></td>
                    <td>{{ $mesin->tahun_mesin }}</td>
                    <td>{{ $mesin->lok_ws }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info" role="alert">
        Tidak ditemukan hasil untuk pencarian ini.
    </div>
    @endif
</div>
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

    .table.table-bordered th:nth-child(3),
    .table.table-bordered td:nth-child(3) {
        width: 15%;
    }

    .table.table-bordered th:nth-child(4),
    .table.table-bordered td:nth-child(4) {
        width: 8%;
    }

    .table.table-bordered th:nth-child(5),
    .table.table-bordered td:nth-child(5) {
        width: 10%;
    }

    .table.table-bordered th:nth-child(6),
    .table.table-bordered td:nth-child(6) {
        width: 12%;
    }

    .table.table-bordered th:nth-child(7),
    .table.table-bordered td:nth-child(7) {
        width: 10%;
    }

    .table.table-bordered th:nth-child(8),
    .table.table-bordered td:nth-child(8) {
        width: 5%;
    }

    .table.table-bordered th:nth-child(9),
    .table.table-bordered td:nth-child(9) {
        width: 5%;
    }

    .table.table-bordered th:nth-child(10),
    .table.table-bordered td:nth-child(10) {
        width: 10%;
    }
</style>
@endsection