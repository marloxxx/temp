@extends('layout.main')
@section('title'){{'Peminjaman'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Daftar Peminjaman Mesin</h1>
  <p class="mb-4">Berikut Merupakan Daftar Peminjaman Mesin Mesin</p>

  @if(Session::has('berhasil'))
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Success,</strong>
    {{ Session::get('berhasil') }}
  </div>
  @endif
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <a href="/pinjam/create" class="btn mb-3 btn-primary btn-icon-split btn-sm">Tambah Data Peminjaman</a>
      <a href="/datapinjam/printpdf" class="btn mb-3 btn-success btn-icon-split btn-sm">Print Data Peminjaman</a>

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align:center;">
          <thead style="background-color:#7ce4f3;">

            <tr>
              <th>Id Peminjaman</th>
              <th>Nama Peminjam</th>
              <th>Nama Mesin</th>
              <th>Tanggal Peminjaman</th>
              <th>Lama Peminjaman</th>
              <th>Petugas</th>
              <th>Status</th>
              <th>Ubah</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($peminjaman as $pinjam)
            <tr>
              <td>{{$pinjam->id}}</td>
              <td class="text-capitalize">{{$pinjam->anggota->nama}}</td>
              <td>{{$pinjam->buku->nama_mesin}}</td>
              <td>{{date('d F Y', strtotime($pinjam->tanggal_pinjam))}}</td>
              <td>{{$pinjam->lama_peminjaman}} Hari</td>
              <td>{{$pinjam->user->nama}}</td>
              <td>@if($pinjam->status==1)
                <span class="badge bg-warning text-dark">Dipinjam</span>
                @else
                <span class="badge bg-success">Dikembalikan</span>
                @endif
              </td>
              <td>
                <a class="btn btn-secondary" href="/pinjam/{{$pinjam->id}}" @if ($pinjam -> status == 2)
                  style="pointer-events: none;"
                  @endif
                  ><i class="bi bi-gear"></i></a>
                <a class="btn btn-primary" href="/pinjam/{{$pinjam->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                <form action="/pinjam/{{$pinjam->id}}" method="POST">@csrf
                  @method('DELETE')
                  <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini? ')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
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
<!-- /.container-fluid -->
</div>
</div>
@include('sweetalert::alert')
@endsection