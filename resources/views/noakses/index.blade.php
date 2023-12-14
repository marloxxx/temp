@extends('layout.main')
@section('title'){{'Tidak Memilki Akses'}} @endsection
@section('content')
<!DOCTYPE html>
<html>

<head>
    <style>
        .my-button {
            background-color: #3498db;
            /* Warna latar belakang */
            color: #fff;
            /* Warna teks */
            border: none;
            /* Hapus border */
            padding: 10px 20px;
            /* Padding atas dan bawah 10px, kiri dan kanan 20px */
            border-radius: 5px;
            /* Membuat sudut tombol menjadi melengkung */
            font-size: 16px;
            /* Ukuran teks */
            cursor: pointer;
            /* Ubah tampilan kursor saat mengarahkan ke tombol */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Efek bayangan */
            margin: 10px;
            /* Jarak antara tombol */
        }

        .my-button:hover {
            background-color: #258cd1;
            /* Warna latar belakang saat dihover */
        }
    </style>
</head>

<body>
    <div class="container access-denied">
        <div class="row justify-content-center align-items-center" style="height: 80vh;">
            <div class="col-md-6 text-center">
                <p class="text-danger h2">Tidak ada akses</p>
                <a href="/"><button class="my-button">Home</button></a>
</body>

</html>
@endsection