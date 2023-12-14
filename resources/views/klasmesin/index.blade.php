@extends('layout.main')
@section('title'){{ 'Data Klasifikasi' }}@endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Klasifikasi</h1>
    <p class="mb-4">Berikut Merupakan Data Klasifikasi</p>

    @if(Session::has('berhasil'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success:</strong> {{ Session::get('berhasil') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="klasifikasi-mesin/create" class="btn mb-3 btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#tambahDataModal">Tambah Data</a>
            <button type="button" class="btn btn-success btn-icon-split btn-sm mb-3" data-toggle="modal" data-target="#importModal">IMPORT</button>
            <a href="/klasifikasi-export-excel" class="btn btn-success btn-icon-split btn-sm mb-3">EXPORT</a>
            <button type="button" class="btn btn-success btn btn-danger btn-sm mb-3" data-toggle="modal" data-target="#resetModal">RESET</button>
            <div class="row px-3 py-3">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Klasifikasi</th>
                                    <th>Kode Klasifikasi</th>
                                    <th>Ubah</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($post->sortBy('nama_kategori') as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->nama_klasifikasi }}</td>
                                    <td>{{ $kategori->kode_klasifikasi }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="klasifikasi-mesin/{{$kategori->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                                        <form action="/klasifikasi-mesin/{{$kategori->id}}" method="POST">@csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini? ')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection