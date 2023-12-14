@extends('layout.main')
@section('title', 'QrCode Mesin')
@section('content')
<div class="container text-center mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2>ID: {{$mesin->kode_jenis}}</h2>
        </div>
        <div class="card-body">
            <div class="qr-code">
                {!! $qrCode !!}
            </div>
            <h3 class="mt-4">Scan QR Code</h3>
            <p class="text-muted">{{$mesin->nama_mesin}}</p>
        </div>
    </div>
    <div class="mt-3">
        <div class="button-container">
            <button class="btn btn-primary" onclick="printQRCode()">Cetak QR Code</button>
        </div>
    </div>
</div>
<style>
    .qr-code {
        text-align: center;
        padding: 20px;
    }

    .button-container {
        display: block;
    }

    @media print {

        /* Menyembunyikan tombol "Cetak QR Code" saat mencetak */
        .button-container {
            display: none;
        }
    }
</style>
<script>
    function printQRCode() {
        window.print();
    }
</script>
@endsection