@extends('layout.main')
@section('title'){{'Laporan'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Laporan</h1>
  <p class="mb-4">Berikut Merupakan Data Laporan peminjaman</p>

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
      <form method="GET" action="">
        <div class="row">
          <div class="col-lg-2">
            <span>Dari Tanggal</span>
            <input class="form-control" type="date" name="datefrom" id="datefrom">
          </div>
          <div class="col-lg-2">
            <span>Sampai Tanggal</span>
            <input class="form-control" type="date" name="dateto" id="datefrom">
          </div>
          <div class="col-lg-5">
            <input style="margin-top:21px;" class="btn btn-primary" type="submit" value="SEARCH">
          </div>
          <div class="col-lg-3">
            {{-- <input style="margin-left: 80px; margin-top:21px;"  class="btn btn-success" type="submit" value="Print Data Laporan"> --}}
          </div>
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead style="background-color:#7ce4f3;">
            <h4>Data Peminjaman</h4>
            <tr>
              <th>Id Peminjaman</th>
              <th>Nama Peminjam</th>
              <th>Nama Mesin</th>
              <th>Tanggal Peminjaman</th>
              <th>Lama Peminjaman</th>
              <th>Petugas</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($laporanPeminjaman as $pinjam)
            <tr>
              <td>{{$pinjam->id}}</td>
              <td class="text-capitalize">{{$pinjam->anggota->nama}}</td>
              <td>{{$pinjam->buku->judul_buku}}</td>
              <td>{{$pinjam->tanggal_pinjam}}</td>
              <td>{{$pinjam->lama_peminjaman}} Hari</td>
              <td>{{$pinjam->user->nama}}</td>
              <td>@if($pinjam->status==1)
                <span class="badge bg-warning text-dark">Dipinjam</span>
                @else
                <span class="badge bg-success">Dikembalikan</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead style="background-color:#7ce4f3;">
            <h4>Data Pengembalian</h4>
            <tr>
              <th>Id Pengembalian</th>
              <th>Nama Peminjam</th>
              <th>Nama Buku</th>
              <th>Tanggal Peminjaman</th>
              <th>Tanggal Pengembalian</th>
              <th>Petugas</th>
              <th>Status</th>
              <th>Denda</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($laporanPengembalian as $kembali)
            <tr>
              <td>{{$kembali->id}}</td>
              <td class="text-capitalize">{{$kembali->peminjaman->anggota->nama}}</td>
              <td>{{$kembali->peminjaman->buku->judul_buku}}</td>
              <td>{{$kembali->peminjaman->tanggal_pinjam}}</td>
              <td>{{$kembali->tanggal_kembali}}</td>
              <td>{{$kembali->peminjaman->user->nama}}</td>
              <td>@if($kembali->peminjaman->status==1)
                <span class="badge bg-warning text-dark">Dikembali</span>
                @else
                <span class="badge bg-success">Dikembalikan</span>
                @endif
              </td>
              <td>@if($kembali->denda)
                Rp. {{number_format($kembali->denda)}}
                @else
                -
                @endif</td>
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
@endsection