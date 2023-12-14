<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laporan</title>
</head>

<body>
    <ol>
        <!-- Loop integrated into the ordered list -->
        @foreach($data as $pdf)
        <h3>
            <center>Permohonan Perbaikan Peralatan/Mesin dan Keselamatan Kerja</center>
        </h3>
        <p>
            <center>No Registrasi:{{ $pdf->reg_mesin }}</center><br><br>
        </p>
        <li>
            <label for="nama_pemohon">Nama Pemohon:</label>
            <strong><span id="nama_pemohon" style="margin-right: 80px;">{{ $pdf->nama_pemohon }}</span></strong>
            <label for="tanggal_permintaan">Tanggal Permintaan:</label>
            <span id="tanggal_permintaan" style="margin-right: 80px;">{{ $pdf->tanggal_minta }}</span>
        </li>
        <li>
            <label for="workshop">Workshop:</label>
            <span id="workshop" style="margin-right: 40px;">{{ $pdf->workshop }}</span>
            <label for="tanggal_kerusakan">Tanggal & Waktu terjadi kerusakan:</label>
            <span id="tanggal_kerusakan" style="margin-right: 40px;">{{ $pdf->tanggal_terjadi }}</span>
        </li>
        <li>
            <label for="nama_mesin">Nama Mesin:</label>
            <strong><span id="nama_mesin">{{ $pdf->nama_mesin }}</span></strong>
        </li>
        <li>
            <label for="uraian_kerusakan">Uraian Kerusakan:</label><br>
            <textarea id="uraian_kerusakan" rows="5" cols="50" style="font-family: 'Arial', sans-serif;">{{ $pdf->uraian }}</textarea>
        </li>
        <li>
            <label for="selesai_perbaiki">Permintaan Selesai diperbaiki:</label><br>
            <textarea id="selesai_perbaiki" rows="5" cols="50" style="font-family: 'Arial', sans-serif;">{{ $pdf->minta_perbaiki }}</textarea>
        </li>
        @endforeach
    </ol>
    <h3>
        <center>Laporan Analisa Kerusakan dan Perbaikan</center>
    </h3>
    <ol>
        <li>
            <label for="nama_pemohon">Nama Teknisi Yang Memperbaiki</label>
            <span id="nama_pemohon">__________________________</span>
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
    </ol>
    <h3>
        <center>Timbal Balik / Feed back dari Pemohon</center>
    </h3>
    <ol>
        <li>
            <label>Hasil Perbaikan:</label><br>
            <input type="checkbox" id="kembali_normal" name="hasil_perbaikan" value="kembali_normal">
            <label for="kembali_normal">Kembali Normal</label>
            <input type="checkbox" id="tidak_kurang_normal" name="hasil_perbaikan" value="tidak_kurang_normal">
            <label for="tidak_kurang_normal">Tidak/Kurang Normal</label>
        </li>
        <li>
            <label for="selesai_perbaiki">Uraian hasil Perbaikan (Jika dirasa tidak/kurang normal)</label><br>
            <textarea id="selesai_perbaiki" rows="5" cols="50"></textarea>
        </li>
    </ol>

    <!-- Rest of the content remains unchanged -->

</body>

</html>