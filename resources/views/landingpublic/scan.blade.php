@extends('layout.main')
@section('title'){{'Qr Code'}} @endsection
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://cdn.jsdelivr.net/npm/quagga"></script>
</head>

<body>
    <h1>QR Code Scanner</h1>
    <div id="scanner-container"></div>
    <p id="result">Hasil scan akan muncul di sini.</p>

    <script>
        // Konfigurasi QuaggaJS
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector("#scanner-container"),
                constraints: {
                    width: 250,
                    height: 250,
                    facingMode: "environment", // Menggunakan kamera belakang (back camera)
                },
            },
            decoder: {
                readers: ["code_128_reader", "ean_reader", "qr_code"],
            },
        });

        // Tambahkan event listener untuk hasil scan
        Quagga.onDetected(function(result) {
            var code = result.codeResult.code;

            // Tambahkan log ke konsol
            console.log("Hasil Scan:", code);

            // Memanggil rute untuk menghasilkan QR Code
            var qrCodeUrl = "{{ route('qrcode.generate', ['code' => ':code']) }}";
            qrCodeUrl = qrCodeUrl.replace(':code', code);

            // Menampilkan hasil QR Code
            var qrCodeImg = '<img src="' + qrCodeUrl + '" alt="QR Code" style="width: 150px; height: 150px;">';
            document.getElementById("result").innerHTML = "Hasil Scan: " + qrCodeImg;
        });

        // Mulai QuaggaJS
        Quagga.start();
    </script>
</body>

</html>
<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    h1 {
        text-align: center;
    }
</style>
@include('sweetalert::alert')
@endsection