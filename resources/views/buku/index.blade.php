@extends('layout.main')
@section('title'){{'Daftar Mesin'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Mesin</h1>
  <p class="mb-4">Berikut merupakan data Mesin di Maintenace</p>

  @if(Session::has('berhasil'))
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Success,</strong>
    {{ Session::get('berhasil') }}
  </div>
  @endif
  <!-- DataTales Example -->
  <a href="/datamesin/create" class="btn mb-3 btn-primary btn-icon-split btn-sm">Tambah Data Mesin</a>
  <a href="/mesin/printpdf" class="btn mb-3 btn-success btn-icon-split btn-sm">Print Data Mesin</a>
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="">
      <thead>
        <tr>

          <th>No.Registrasi</th>
          <th>Nama Mesin</th>
          <th>Lokasi Workshop</th>
          <!--
          <th>Gambar Mesin</th>
          -->
          <th>Spesifikasi</th>
          <th>Jumlah Mesin</th>
          <!--
          <th>Posisi</th>
          -->
          <th>Di Input Oleh:</th>
          <th>Ubah</th>

        </tr>
      </thead>
      <tbody>

        @foreach ($post as $buku)
        <tr>

          <td>{{$buku -> no_mesin}}
          <td class="text-capitalize">{{$buku->nama_mesin}}</td>
          <td>{{$buku->data_kategori->nama_kategori}}</td>
          <!--
          <td><img src="{{ asset('storage/'.$buku -> book_image) }}" alt="" height="90px" width="90px" class="rounded" style="object-fit: cover"></td>
          -->
          <td>{{$buku->spek}}</td>
          <td>{{$buku->jumlah}}</td>
          <!--
          <td>{{$buku->data_kategori->nama_kategori}}</td>
          -->
          <td>{{$buku->user->nama}}</td>
          <!--
              <td>
                <a class="btn btn-info" href="/datamesin/{{$buku->id}}"><i class="bi bi-eye"></i></a>
                <a class="btn btn-primary" href="/datamesin/{{$buku->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                <form action="/datamesin/{{$buku->id}}" method="POST">@csrf
                  @method('DELETE')
                  <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini? ')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </form>
                <a class="btn btn-info" href="/datamesin/{{$buku->id}}" style="display: inline-block; padding: 5px; background-color: #363062;">
                  <img src="{{ asset('assets/icon/qrcode-solid.svg') }}" alt="Lihat" style="width: 33px; height: 25px;">
                </a>
              </td>
-->
          <td>
            <a class="btn btn-info" href="/datamesin/{{$buku->no_mesin}}"><i class="bi bi-eye"></i></a>
            <a class="btn btn-primary" href="/datamesin/{{$buku->no_mesin}}/edit"><i class="bi bi-pencil-square"></i></a>
            <div style="display: flex; align-items: center;">
              <form action="/datamesin/{{$buku->id}}" method="POST" style="margin-right: 10px;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini? ')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
              </form>
              <a class="btn btn-info" href="/qrcode/{{$buku->no_mesin}}" style="display: inline-block; padding: 5px; background-color: #ECEE81; margin-left: -6px; ">
                <img src="{{ asset('assets/icon/qrcode-solid.svg') }}" alt="Lihat" style="width: 34px; height: 27px;">
              </a>
            </div>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
<div class="d-flex justify-content-center">
  {{$post -> links()}}
</div>
</div>
<!-- /.container-fluid -->
</div>
</div>
@include('sweetalert::alert')
@endsection