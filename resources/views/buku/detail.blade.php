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
                <div class="card-body">
                    <div class="text-center mb-4">
                        <a data-fancybox="gallery" href="{{ asset('storage/'.$data_bukus->book_image) }}">
                            <img src="{{ asset('storage/'.$data_bukus->book_image) }}" alt="Gambar Mesin" class="rounded img-variant" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-primary">No.Registrasi</td>
                                <td>{{$data_bukus->no_mesin}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Nama Mesin</td>
                                <td>{{$data_bukus->nama_mesin}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">ID Kategori</td>
                                <td>{{$data_bukus->data_kategori->nama_kategori}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Spesifikasi</td>
                                <td>{{$data_bukus->spek}}</td>
                            </tr>
                            <tr>
                                <td class="text-primary">Jumlah</td>
                                <td>{{$data_bukus->jumlah}}</td>
                            </tr>
                            <tr>
                                <td class="text-history">Status</td>
                                <td><a class="text-history" href="/mesin/printpdf">History</a></td>
                            </tr>
                            <tr>
                                <td class="text-primary">Diinput Oleh</td>
                                <td>{{$data_bukus->user->nama}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-success" href="/datamesin">Kembali</a>
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