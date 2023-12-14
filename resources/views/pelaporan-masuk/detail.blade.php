@extends('layout.main')
@section('title'){{'Detail Pelaporan Masuk'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pelaporan Masuk</h1>
    <p class="mb-4">Berikut Merupakan Detail Pelaporan Masuk</p>

    @if(Session::has('berhasil'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success,</strong>
        {{ Session::get('berhasil') }}
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                @if (auth()->user()->level == 'Supervisor' || auth()->user()->level == 'Supervisor' && $pelaporan->status == 'menunggu')
                <div class="col-lg-8">
                    @elseif (auth()->user()->level=='Petugas' && $pelaporan->status == 'sedang diperbaiki')
                    <div class="col-lg-8">
                        @else
                        <div class="col-lg-12">
                            @endif
                            <div class="card card-primary">
                                <div class="card-header">
                                    Detail Pelaporan
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="nm_barang">Nama Mesin</label>
                                                <input type="text" name="nm_barang" class="form-control" value="{{ $pelaporan->datamesin->nama_mesin }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="kd_barang">Kode Mesin</label>
                                                <input type="text" name="kd_barang" class="form-control" value="{{ $pelaporan->datamesin->kode_jenis }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="status">Status Pelaporan</label>
                                            @if ($pelaporan->status == 'menunggu')
                                            <div class="alert alert-warning" role="alert">
                                                {{ $pelaporan->status }}
                                            </div>
                                            @elseif($pelaporan->status == 'sedang diperbaiki')
                                            <div class="alert alert-primary" role="alert">
                                                {{ $pelaporan->status }}
                                            </div>
                                            @elseif($pelaporan->status == 'selesai')
                                            <div class="alert alert-success" role="alert">
                                                {{ $pelaporan->status }}
                                            </div>
                                            @elseif($pelaporan->status == 'menunggu feedback')
                                            <div class="alert alert-info" role="alert">
                                                {{ $pelaporan->status }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="kategori">Kategori Mesin</label>
                                                <input type="text" name="kategori" class="form-control" value="{{ $pelaporan->datamesin->kategori->nama_kategori }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="merk">Merek Barang</label>
                                                <input type="text" name="merk" class="form-control" value="{{ $pelaporan->datamesin->merk_mesin }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="lokasi">Lokasi Mesin</label>
                                                <input type="text" name="lokasi" class="form-control" value="{{ $pelaporan->datamesin->workshop->nama_workshop }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="judul">No Registrasi Pelaporan</label>
                                        <input type="text" name="judul" class="form-control" value="{{ $pelaporan->no_registrasi }}" disabled>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="deskripsi">Uraian Kerusakan</label>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" disabled>{{ $pelaporan->deskripsi }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4" {{ $pelaporan->status == 'sedang diperbaiki' && auth()->user()->level=='Supervisor' || auth()->user()->level=='Admin' ? 'hidden' : '' }} {{ $pelaporan->status == 'menunggu' && auth()->user()->level=='Petugas' ? 'hidden' : '' }}>
                            <div class="card card-primary">
                                <div class="card-header">
                                    Aksi
                                </div>
                                <div class="card-body">
                                    @if ($pelaporan->status == 'menunggu')
                                    <div class="alert alert-secondary mb-4">
                                        <i class="fa-solid fa-angles-right"></i> Button "Perbaiki" menandakan bahwa barang sedang
                                        diperbaiki <br><br>
                                        <i class="fa-solid fa-angles-right"></i> Button "Selesai" menandakan bahwa barang sudah
                                        diperbaiki
                                    </div>
                                    <form id="perbaikiForm{{ $pelaporan->id }}" action="/pelaporan/masuk/detail/{{ $pelaporan->id }}/perbaiki" class="d-inline float-right" method="POST">
                                        @method('put')
                                        @csrf
                                        <button type="button" class="btn btn-primary" onclick="confirmPerbaiki('{{ $pelaporan->id }}')">
                                            <i class="fa-solid fa-screwdriver-wrench"></i> Perbaiki
                                        </button>
                                    </form>
                                    @elseIf($pelaporan->status == 'sedang diperbaiki')
                                    <div class="row text-center">
                                        <button type="button" class="btn btn-success btn-lg" onclick="confirmSelesai('{{ $pelaporan->id }}')">
                                            <i class="fas fa-check"></i> Buat Analisis
                                        </button>
                                    </div>
                                    @elseif($pelaporan->status == 'selesai')
                                    @if ($feedback && $feedback->analisis_perbaikan)
                                    <label for="analisis_perbaikan">From Admin</label><br>
                                    <div class="alert alert-light">
                                        {{ $feedback->analisis_perbaikan }}
                                    </div>
                                    @else
                                    @endif

                                    @if ($feedbackReply && $feedbackReply->feedback_replies && $feedbackReply->feedback_replies)
                                    <label for="feedback_replies">From User</label><br>
                                    <div class="alert alert-primary">
                                        {{ $feedbackReply->feedback_replies }}
                                    </div>
                                    @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('sweetalert::alert')
                <script>
                    function confirmPerbaiki(id) {
                        Swal.fire({
                            title: 'Konfirmasi',
                            text: 'Apakah Anda yakin ingin memngubah status pelaporan menjadi Sedang Diperbaiki?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Perbaiki!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('perbaikiForm' + id).submit();
                            }
                        });
                    }

                    function confirmSelesai(id) {
                        // Swal.fire({
                        //     title: 'Konfirmasi',
                        //     text: 'Apakah Anda yakin pelaporan ini sudah selesai?',
                        //     icon: 'question',
                        //     showCancelButton: true,
                        //     confirmButtonColor: '#28a745',
                        //     cancelButtonColor: '#d33',
                        //     confirmButtonText: 'Ya, Selesai!'
                        // }).then((result) => {
                        //     if (result.isConfirmed) {
                        //         document.getElementById('selesaiForm' + id).submit();
                        //     }
                        // });
                        window.location.href = "/pelaporan/analisis/create/" + id;
                    }
                </script>
                @endsection