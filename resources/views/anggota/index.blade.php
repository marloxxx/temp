@extends('layout.main')
@section('title'){{'Data Pegawai'}} @endsection
@section('content')
<!-- Begin Page Content -->
@if(auth()->user()->level=='Admin')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Karyawan</h1>
  <p class="mb-4">Berikut merupakan data Karyawan Maintenace</p>

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
      <a href="/pegawai/create" class="btn mb-3 btn-primary btn-icon-split btn-sm">Tambah Data Karyawan</a>
      <a href="/pegawai/pdf" class="btn mb-3 btn-success btn-icon-split btn-sm">Print Data Karyawan</a>
      <div class="table-responsive">
        <table class="table table-bordered" style="text-align:center;" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Foto</th>
              <th>NIK</th>
              <th>NAMA LENGKAP</th>
              <th>Bagian / Jabatan</th>
              <th>Ubah</th>

            </tr>
          </thead>
          <tbody>

            @foreach ($post as $anggota)
            <tr>
              <td>{{$anggota->id}}</td>
              <td><img src="{{ asset('storage/'.$anggota->image) }}" alt="" height="90px" width="90px" class="rounded" style="object-fit: cover"></td>
              <td>{{$anggota->nik}}</td>
              <td>{{$anggota->nama}}</td>
              <td>{{$anggota->jabatan}}</td>
              <td style="text-align:left;">
                <a class="btn btn-info" href="/pegawai/{{$anggota->nik}}"><i class="bi bi-eye"></i></a>
                <a class="btn btn-primary" href="/pegawai/{{$anggota->nik}}/edit"><i class="bi bi-pencil-square"></i></a>
                <form action="/pegawai/{{$anggota->id}}" method="POST">@csrf
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
    {{$post -> links()}}
  </div>
</div>
<!-- /.container-fluid -->
</div>
@else

<div class="container access-denied">
  <div class="row justify-content-center align-items-center" style="height: 80vh;">
    <div class="col-md-6 text-center">
      <p class="text-danger h2">Tidak ada akses</p>
    </div>
  </div>
</div>
@endif
@include('sweetalert::alert')
@endsection