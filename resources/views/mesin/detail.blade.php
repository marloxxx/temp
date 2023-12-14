@extends('layout.main')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Detail Mesin</h4>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <a data-fancybox="gallery" href="{{ asset('storage/'.$datamesin->gambar_mesin) }}">
                                    <img src="{{ asset('storage/'.$datamesin->gambar_mesin) }}" alt="Gambar Mesin" class="rounded img-variant" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                </a>
                            </div>
                            <tr>
                                <td class="text-primary">No.Registrasi</td>
                                <td>{{ $datamesin->kode_jenis }}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Kategori Mesin</td>
                                <td>{{$datamesin->kategori->nama_kategori}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Klasifikasi Mesin</td>
                                <td>{{$datamesin->klasifikasi->nama_klasifikasi}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Nama Mesin</td>
                                <td>{{$datamesin->nama_mesin}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Type</td>
                                <td>{{$datamesin->type_mesin}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Merk</td>
                                <td>{{$datamesin->merk_mesin}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Spesifikasi:</td>
                            </tr>
                            <tr>
                                <td class="text-primary" align="right">Min.</td>
                                <td>{{$datamesin->spek_min}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary" align="right">Max.</td>
                                <td>{{$datamesin->spek_max}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Pabrikan</td>
                                <td>{{$datamesin->pabrik}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">kapasitas</td>
                                <td><span style="text-align:center;">{{ $datamesin->kapasitas }} (Ton)</span></td>
                            </tr>
                            <tr>
                                <td class="text-primary">Tahun Mesin</td>
                                <td>{{$datamesin->tahun_mesin}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Lokasi</td>
                                <td>{{$datamesin->lok_ws}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a class="btn btn-success" href="/data-mesin">Kembali</a>
                <a class="btn btn-success" href="/data-mesin/{{$datamesin->id}}/edit">Ubah Data</a>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    .history {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 6px 12px;
        gap: 8px;
        height: 36px;
        width: 120px;
        border: none;
        background: #5e41de33;
        border-radius: 20px;
        cursor: pointer;
    }

    .text-history {
        color: #007bff;
        height: 36px;
        width: 120px;
    }

    .img-variant {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s;
    }

    .img-variant:hover {
        transform: scale(1.1);
    }

    .text-primary {
        color: #007bff;
    }
</style>
<script>
    $(document).ready(function() {
        $("[data-fancybox]").fancybox();
    });
</script>
@endsection