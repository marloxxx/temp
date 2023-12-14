@extends('layout.main')
@section('title'){{'Data Barang Masuk'}} @endsection
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Mesin Masuk</h1>
    <p class="mb-4">Berikut merupakan data Mesin masuk di Maintenance</p>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Instascan</title>
        <script type="text/javascript" src="{{ asset('assets/qrcode/instascan.min.js') }}"></script>
    </head>

    <body>
        <video id="preview"></video>
        <script type="text/javascript">
            let scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });
            scanner.addListener('scan', function(content) {
                console.log(content);
            });
            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
            });
        </script>
    </body>

    </html>
    @endsection