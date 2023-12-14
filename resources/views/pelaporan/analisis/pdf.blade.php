<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laporan</title>
</head>

<body>
    <h3>
        <center>Laporan Analisa Kerusakan dan Perbaikan</center>
    </h3>
    @foreach($data as $pdf)
    <ol>
        <li>
        <li>
            <label for="nama_pemohon">Nama Pemohon:</label>
            <strong><span id="nama_pemohon" style="margin-right: 80px;">{{ $pdf->nama_teknisi }}</span></strong>
        </li>
        </li>
        <li>
            <label for="waktu_baik">Waktu Perbaikan</label>
            <span id="workshop">_____________________</span>
            <label for="tanggal_kerusakan">s/d</label>
            <span id="tanggal_kerusakan">______________________</span>
        </li>
        <li>
            <label for="uraian_kerusakan">Analisa Perbaikan:</label><br>
            <textarea id="uraian_kerusakan" rows="5" cols="50"></textarea>
        </li>
        <li>
            <label for="selesai_perbaiki">Tindakan Perbaikan:</label><br>
            <textarea id="selesai_perbaiki" rows="5" cols="50"></textarea>
        </li>
        <li>
            <label for="">Saran-saran Tindakan untuk pencegahan agar tidak terjadi rusak kembali</label>
            <textarea id="" rows="5" cols="50"></textarea>
        </li>
        @endforeach
    </ol>
</body>

</html>