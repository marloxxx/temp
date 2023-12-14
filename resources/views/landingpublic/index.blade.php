<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spesifikasi {{$datamesin->nama_mesin}}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

</head>

<body>
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                <div class="card swiper-slide">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <a data-fancybox="gallery" href="{{ asset('storage/'.$datamesin->gambar_mesin) }}">
                                <img src="{{ asset('storage/'.$datamesin->gambar_mesin) }}" class="card-image" style="max-width: 100%; height: 100%;">
                            </a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-title">
                            <h2 class="description">{{$datamesin->lok_ws}}</h2>
                            <p class="spek">{{$datamesin->nama_mesin}}</p>
                        </div>
                        <div class="card-details">
                            <div class="detail-item">
                                <button id="spek" class="button">Spesifikasi Mesin</button>
                            </div>
                            <div class="detail-item">
                                <button id="laporan" class="button">Laporan Perbaikan</button>
                            </div>
                            <div class="detail-item">
                                <button class="button">History Perbaikan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Spesifikasi -->
    <div class="modal fade" id="spesifikasiModal" tabindex="-1" role="dialog" aria-labelledby="spesifikasiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="spesifikasiModalLabel">Spesifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                            </div>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" href="/pengajuan1">Pengajuan</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

    <!-- Quagga JS -->
    <script src="https://cdn.jsdelivr.net/npm/quagga"></script>

    <script>
        // ... kode Quagga lainnya ...

        document.getElementById('spek').addEventListener('click', function() {
            // Tampilkan modal spesifikasi
            $('#spesifikasiModal').modal('show');
        });

        document.getElementById('laporan').addEventListener('click', function() {
            window.location.href = '/laporan-perbaikan';
        });
        $(document).ready(function() {
            $("[data-fancybox]").fancybox();
        });
    </script>

    <style>
        /* ... style yang sudah ada ... */
    </style>
</body>

</html>

<style>
    /* Google Fonts - Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #EFEFEF;
    }

    .slide-container {
        max-width: 1120px;
        width: 100%;
        padding: 40px 0;
    }

    .slide-content {
        margin: 0 40px;
        overflow: hidden;
        border-radius: 25px;
    }

    .card {
        border-radius: 25px;
        background-color: #FFF;
    }

    .image-content,
    .card-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px 14px;
    }

    .image-content {
        position: relative;
        row-gap: 5px;
        padding: 25px 0;
    }

    .overlay {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        background-color: #4070F4;
        border-radius: 25px 25px 0 25px;
    }

    .overlay::before,
    .overlay::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: -40px;
        height: 40px;
        width: 40px;
        background-color: #4070F4;
    }

    .overlay::after {
        border-radius: 0 25px 0 0;
        background-color: #FFF;
    }

    .card-image {
        position: relative;
        height: 150px;
        width: 150px;
        border-radius: 50%;
        background: #FFF;
        padding: 3px;
    }

    .card-image .card-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #4070F4;
    }

    .name {
        font-size: 18px;
        font-weight: 500;
        color: #333;
    }

    .description {
        font-size: 14px;
        color: #707070;
        text-align: center;
    }

    .button {
        border: none;
        font-size: 16px;
        color: #FFF;
        padding: 8px 16px;
        background-color: #4070F4;
        border-radius: 6px;
        margin: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 300px;
        /* Atur lebar sesuai kebutuhan Anda */
    }

    .button:hover {
        background: #265DF2;
    }

    .swiper-navBtn {
        color: #6E93f7;
        transition: color 0.3s ease;
    }

    .swiper-navBtn:hover {
        color: #4070F4;
    }

    .swiper-navBtn::before,
    .swiper-navBtn::after {
        font-size: 35px;
    }

    .swiper-button-next {
        right: 0;
    }

    .swiper-button-prev {
        left: 0;
    }

    .swiper-pagination-bullet {
        background-color: #6E93f7;
        opacity: 1;
    }

    .swiper-pagination-bullet-active {
        background-color: #4070F4;
    }

    @media screen and (max-width: 768px) {
        .slide-content {
            margin: 0 10px;
        }

        .swiper-navBtn {
            display: none;
        }
    }

    .footer {
        color: #000000;
        text-align: center;
        padding: 10px;
        position: fixed;
        bottom: 0;
        width: 100%;
        left: 0;
    }

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