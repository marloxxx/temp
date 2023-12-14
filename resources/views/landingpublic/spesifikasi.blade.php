<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">

                <div class="card swiper-slide">
                    <div class="image-content">
                        <span class="overlay"></span>

                        <div class="card-image">
                            <img src="{{ asset('assets/images/logodhj.jpg') }}" alt="" class="card-img">
                        </div>
                    </div>

                    <div class="card-content">
                        <h2 class="name">MAINTENANCE</h2>
                        <p class="description">Deskripsi</p>

                        <button id="spek" class="button">Spesifikasi Mesin</button>
                        <button id="laporan" class="button">Laporan Perbaikan</button>
                        <button class="button">History Perbaikan</button>
                        <div class="footer">
                            <p>&copy; 2023 Maintenance. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</html>
<script src="https://cdn.jsdelivr.net/npm/quagga"></script>
<script>
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector("#scanner-container"),
            constraints: {
                width: 640,
                height: 480,
            },
        },
        decoder: {
            readers: ["code_128_reader", "ean_reader", "qr_code"],
        },
    });

    Quagga.onDetected(function(result) {
        var code = result.codeResult.code;
        document.getElementById("spesifikasi-link").href = "/landing/spesifikasi/" + code;
        document.getElementById("spesifikasi-link").style.display = "inline-block";
        Quagga.stop();
    });

    Quagga.start();
</script>
<script>
    document.getElementById('spek').addEventListener('click', function() {
        window.location.href = '/landing/spesifikasi/{kode_jenis}';
    });
    document.getElementById('laporan').addEventListener('click', function() {
        window.location.href = '/laporan-perbaikan';
    });
</script>
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
</style>