<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laporan</title>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="assets/images/laporan/header.png" alt="Logo Laporan">
        </div>
    </div>
    <h3>
        <center>Permohonan Perbaikan Peralatan/Mesin dan Keselamatan Kerja</center>
    </h3>
    <p>
        <center>No Registrasi: {{ $pelaporan->no_registrasi }}</center>
    </p>
    </div>
    </div>

    <ol>
        <li>
            <label for="nama_pemohon">Nama Pemohon:</label>
            <span id="nama_pemohon" style="font-weight: bold">{{ $pelaporan->user->nama }}</span>
            <label for="tanggal_permintaan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal Permintaan:</label>
            <span id="tanggal_permintaan">{{ $pelaporan->tanggal_permintaan }}</span>
        </li>
        <li>
            <label for="workshop">Workshop:</label>
            <span id="workshop">{{ $pelaporan->datamesin->lok_ws }}</span>
            <label for="tanggal_kerusakan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal & Waktu terjadi kerusakan:</label>
            <span id="tanggal_kerusakan">{{ $pelaporan->tanggal_kerusakan }}</span>
        </li>
        <li>
            <label for="nama_mesin">Nama Mesin:</label>
            <span id="nama_mesin" style="font-weight: bold">{{ $pelaporan->datamesin->nama_mesin }}</span>
        </li>
        <li>
            <label for="uraian_kerusakan">Uraian Kerusakan:</label><br>
            <textarea id="uraian_kerusakan" rows="5" cols="50">{{ $pelaporan->deskripsi }}</textarea>
        </li>
        <li>
            <label for="selesai_perbaiki">Permintaan Selesai diperbaiki:</label><br>
            <textarea id="selesai_perbaiki" rows="5" cols="50">{{ $pelaporan->feedback->created_at }}</textarea>
        </li>
    </ol>
    <h3>
        <center>Laporan Analisa Kerusakan dan Perbaikan</center>
    </h3>
    <ol>
        <li>
            <label for="nama_pemohon">Nama Teknisi Yang Memperbaiki :</label>
            <span id="nama_pemohon">{{ $pelaporan->analisis->user->nama }}</span>
        </li>
        <li>
            <label for="waktu_baik">Waktu Perbaikan :</label>
            <span id="workshop">{{ $pelaporan->created_at }}</span>
            <label for="tanggal_kerusakan">s/d</label>
            <span id="tanggal_kerusakan">{{ $pelaporan->analisis->created_at }}</span>
        </li>
        <li>
            <label for="uraian_kerusakan">Analisa Perbaikan:</label><br>
            <textarea id="uraian_kerusakan" rows="5" cols="50">{{ $pelaporan->analisis->analisa }}</textarea>
        </li>
        <li>
            <label for="selesai_perbaiki">Tindakan Perbaikan:</label><br>
            <textarea id="selesai_perbaiki" rows="5" cols="50">{{ $pelaporan->analisis->tindakan }}</textarea>
        </li>
        <li>
            <label for="">Saran-saran Tindakan untuk pencegahan agar tidak terjadi rusak kembali</label>
            <textarea id="" rows="5" cols="50">{{ $pelaporan->analisis->saran }}</textarea>
        </li>
    </ol>
    <h3>
        <center>Timbal Balik / Feed back dari Pemohon</center>
    </h3>
    <ol>
        <li>
            <label>Hasil Perbaikan:</label><br>
            <input type="checkbox" id="kembali_normal" name="hasil_perbaikan" value="kembali_normal" {{ $pelaporan->feedback->hasil_perbaikan == 'normal' ? 'checked' : ''  }}>
            <label for="kembali_normal">Kembali Normal</label>
            <input type="checkbox" id="tidak_kurang_normal" name="hasil_perbaikan" value="tidak_kurang_normal" {{ $pelaporan->feedback->hasil_perbaikan == 'kurang_normal' ? 'checked' : ''  }}>
            <label for="tidak_kurang_normal">Tidak/Kurang Normal</label>
        </li>
        <li>
            <label for="selesai_perbaiki">Uraian hasil Perbaikan (Jika dirasa tidak/kurang normal)</label><br>
            <textarea id="selesai_perbaiki" rows="5" cols="50">{{ $pelaporan->feedback->uraian_perbaikan }}</textarea>
        </li>
        {{-- @foreach($data as $pdf)
        <tr>
            <td>{{ $loop->iteration }}</td>
        <td>{{ $pdf->nama }}</td>
        </tr>
        @endforeach --}}
</body>

</html>

<style>
    #uraian_kerusakan {
        width: 100%;
        padding: 4px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
        /* Ganti dengan jenis font yang Anda inginkan */
    }
</style>