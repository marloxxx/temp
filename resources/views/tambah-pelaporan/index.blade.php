@extends('layout.main')
@section('title', 'Tambah Pelaporan')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2>Tambah Pelaporan</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    Scan Barcode Disini
                                </div>
                                <div class="card-body">
                                    <div id="reader" width="600px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="container p-0">
        <div class="card p-0" style="border-radius: 21px;">
            <div class="card-header text-center bg-primary" style="border-radius: 20px;">
                <img src="{{ asset('image/student-female.png') }}" alt="Round Image" class="rounded-image" width="150px" height="150px" id="img_modal">
            </div>
        <div class="card-body">
            <h5 class="card-title text-center text-muted" id="lokasi_modal"></h5>
            <h4 class="text-center fs-3" id="nm_modal"></h4>
            <div class="row g-3 mt-2">
                <input type="text" name="mesin_id" id="mesin_id" class="form-control" placeholder="placeholder" aria-describedby="mesin_id" hidden>
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg" onclick="spekMesin()">Spesifikasi Mesin</button>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg" onclick="cekLaporan()">Laporan Perbaikan</a></button>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg" onclick="historyLaporan()">History Perbaikan</button>
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

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    $( document ).ready(function() {
        $('#spekModal').on('hidden.bs.modal', function (e) {
            $("#spekModalContent").children().remove();
            $("#exampleModal").modal('show');
        })
    });

    function spekMesin() {
        $.ajax({
            url: '/pelaporan/get-spek-mesin',
            method: 'GET',
            data: {
                id: $("#mesin_id").val(),
            },
            success: function(data) {
                var path = `{{ asset('storage/') }}`;
                var html = `<div class="container mt-2">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="mb-0">Detail Mesin</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <div class="card-body">
                                            <div class="text-center mb-4">
                                                <a data-fancybox="gallery" href="`+path+'/'+data.gambar_mesin+`">
                                                    <img src="`+path+'/'+data.gambar_mesin+`" alt="Gambar Mesin" class="rounded img-variant" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                                </a>
                                            </div>
                                            <tr>
                                                <td class="text-primary">No.Registrasi</td>
                                                <td>`+data.kode_jenis+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">Kategori Mesin</td>
                                                <td>`+data.nama_kategori+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">Klasifikasi Mesin</td>
                                                <td>`+data.nama_klasifikasi+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">Nama Mesin</td>
                                                <td>`+data.nama_mesin+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">Type</td>
                                                <td>`+data.type_mesin+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">Merk</td>
                                                <td>`+data.merk_mesin+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">Spesifikasi:</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary" align="right">Min.</td>
                                                <td>`+data.spek_min+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary" align="right">Max.</td>
                                                <td>`+data.spek_max+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">Pabrikan</td>
                                                <td>`+data.pabrik+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">kapasitas</td>
                                                <td><span style="text-align:center;">`+data.kapasitas+` (Ton)</span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">Tahun Mesin</td>
                                                <td>`+data.tahun_mesin+`</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary">Lokasi</td>
                                                <td>`+data.lok_ws+`</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-success" href="/buat-pengajuan/`+data.id+`">Pengajuan</a>
                                <a class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                            </div>
                </div>`
                $("#spekModalContent").append(html);
                $("#exampleModal").modal('hide');
                $("#spekModal").modal('show');
            },
            error: function(error) {
                console.warn(`Code scan error = ${error}`);
            }
        });
    }

    function cekLaporan() {
        window.location.href = `{{ url('/pelaporan/cek/laporan') }}/`+$("#mesin_id").val();
    }

    function historyLaporan() {
        window.location.href = `{{ url('/pelaporan/history') }}/`+$("#mesin_id").val();
    }

    function onScanSuccess(decodedText, decodedResult) {
        $.ajax({
            url: '/pelaporan/get-data-mesin', // Ganti dengan endpoint yang sesuai di Laravel Anda
            method: 'GET',
            data: {
                result: decodedText,
            },
            success: function(response) {
                // Handle the response, update UI with product information
                // $('#result').val(decodedText);
                // $('#id').val(response.id);
                // $('#nm_barang').val(response.nama_mesin);
                // $('#kategori').val(response.kategori);
                // $('#merk').val(response.merk);
                // $('#lokasi').val(response.lokasi);
                // Tambahan informasi lainnya sesuai kebutuhan
                $("#exampleModal").modal('show');
                $("#lokasi_modal").text(response.lokasi);
                $("#nm_modal").text(response.nama_mesin);
                var path = `{{ asset('storage/') }}`;
                $("#img_modal").attr("src", path+'/'+response.gambar);
                $("#mesin_id").val(response.id);
            },
            error: function(error) {
                console.warn(`Code scan error = ${error}`);
            }
        });
    }

    function onScanFailure(rror) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        /* verbose= */
        false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endsection
