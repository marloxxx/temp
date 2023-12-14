@extends('layout.main')
@section('title'){{'Kategori'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Kategori Workshop Mesin</h1>
  <p class="mb-4">Berikut Merupakan Data Kategori Worskhop</p>

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
      <button type="button" class="btn mb-3 btn-primary btn-icon-split btn-sm" data-bs-toggle="modal" data-bs-target="#standard-modal">Tambah Data Pengembalian</button>
      <a href="/datakategori/create" class="btn mb-3 btn-primary btn-icon-split btn-sm">Tambah Data Kategori</a>
      <!--
      <a href="/kategori-mesin/printpdf" class="btn mb-3 btn-success btn-icon-split btn-sm">Print Kategori Mesin</a>
      -->
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nama Workshop</th>
              <!--
                    <th>Foto Kategori</th>
-->
              <th>Deskripsi</th>
              <th>Action</th>


            </tr>
          </thead>
          <tbody>

            @foreach ($post as $kategori)
            <tr>
              <td>{{$kategori -> id}}</td>
              <td>{{$kategori->nama_kategori}}</td>
              <!--
              <td><img src="{{ asset('storage/'.$kategori -> image) }}" alt="" height="80px" width="80px" class="rounded" style="object-fit: cover"></td>
-->
              <td>{{$kategori->deskripsi}}</td>
              <td>
                <a class="btn btn-primary" href="/kategori-mesin/{{$kategori->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                <form action="/datakategori/{{$kategori->id}}" method="POST">@csrf
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
  <div class="d-flex justify-content-center">
    {{$post->links()}}
  </div>
</div>
<!-- /.container-fluid -->
<!-- Standard modal content -->
<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="standard-modalLabel">Pilih Data Peminjaman</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead style="background-color:#7ce4f3;">
            <th style="text-align:center;">Id</th>
            <th style="text-align:center;">Nama</th>
            <th style="text-align:center;">Buku</th>
            <th style="text-align:center;">Action</th>
          </thead>
          <tbody>
            @foreach ($peminjaman as $pinjam)
            @if ($pinjam -> status == 1)
            <tr>
              <td>{{$pinjam->id}}</td>
              <td class="text-capitalize">{{$pinjam->anggota->nama}}</td>
              <td>{{$pinjam->buku->judul_buku}}</td>
              <td><a class="btn btn-secondary" href="/transaksipengembalian/{{$pinjam->id}}"><i class="bi bi-gear"></i></a></td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
@include('sweetalert::alert')
@endsection