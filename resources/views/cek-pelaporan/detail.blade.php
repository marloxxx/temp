@extends('layout.main')
@section('title'){{'Detail Cek Pelaporan'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pelaporan</h1>
    <p class="mb-4">Berikut Merupakan Data Detail Pelaporan</p>

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
                <div class="col-lg-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            Gambar Mesin
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <a data-fancybox="gallery" href="{{ asset('storage/'.$pelaporan->datamesin->gambar_mesin) }}">
                                    <img src="{{ asset('storage/'.$pelaporan->datamesin->gambar_mesin) }}" alt="Gambar Mesin" class="rounded img-variant" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            Barcode Mesin
                        </div>
                        <div class="card-body text-center">
                            <div class="qr-code">
                                {!! $qrCode !!}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            {{ $pelaporan->datamesin->nama_mesin }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col fw-bold">Kode Mesin</div>
                                <div class="col">: {{ $pelaporan->datamesin->kode_jenis }}</div>
                            </div>
                            <div class="row">
                                <div class="col fw-bold">Tanggal Penambahan</div>
                                <div class="col">: {{ $pelaporan->datamesin->created_at }}</div>
                            </div>
                            <div class="row">
                                <div class="col fw-bold">Type Mesin</div>
                                <div class="col">: {{ $pelaporan->datamesin->type_mesin }}</div>
                            </div>
                            <div class="row">
                                <div class="col fw-bold">Merk Mesin</div>
                                <div class="col">: {{ $pelaporan->datamesin->merk_mesin }}</div>
                            </div>
                            <div class="row">
                                <div class="col fw-bold">Lokasi</div>
                                <div class="col">: {{ $pelaporan->datamesin->lok_ws }}</div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        History Perbaikan Mesin
                                        <div class="table-responsive mt-2">
                                            <table class="table table-bordered table-hover" id="datatableMesin">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pelapor</th>
                                                        <th>Deskripsi Kerusakan</th>
                                                        <th>Analisis Perbaikan</th>
                                                        <th>Tanggal Perbaikan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($history as $data)
                                                        <tr>
                                                            <td>{{ $data->id }}</td>
                                                            <td>{{ $nama_pemohon }}</td>
                                                            <td>{{ $data->deskripsi }}</td>
                                                            <td>
                                                                @if ($analisi_perbaikan == 'menunggu')
                                                                    <span class="badge bg-warning p-2">{{ $analisi_perbaikan }}</span>
                                                                @else
                                                                    {{ $analisi_perbaikan }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($analisi_perbaikan == 'menunggu')
                                                                    <span class="badge bg-warning p-2">{{ $tanggal_perbaikan }}</span>
                                                                @else
                                                                    {{ $tanggal_perbaikan }}
                                                                @endif
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Spek -->
<div class="modal fade" id="spekModal" tabindex="-1" aria-labelledby="spekModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body" id="spekModalContent">

            </div>
        </div>
    </div>
</div>

<style>
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
</style>
@include('sweetalert::alert')
<script>
    $(document).ready(function(){
        var status = `{{ $pelaporan->status }}`;
        var user = `{{ $pelaporan->id_pemohon }}`;
        var userNow = `{{ Auth::user()->id }}`;
        var pelaporanId = `{{ $pelaporan->id }}`;

        if (status == 'menunggu feedback' && user == userNow) {
            Swal.fire({
                title: 'Pelaporan Memerlukan Feedback',
                text: 'Silahkan lakukan pengisian feedback perbaikan untuk menyelesaikan laporan!',
                icon: 'info',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then(function(e){
                if (e.isConfirmed) {
                    window.location.href = '/pelaporan/feedback/create/'+pelaporanId;
                }
            });
        }
    });
</script>
@endsection
