<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $datamesin->kode_jenis }}</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <td class="text-primary">No.Registrasi</td>
                <td>{{ $datamesin->kode_jenis }}</td>
            </tr>
            <tr>
                <td class="text-primary">Klasifikasi Mesin</td>
                <td>{{$datamesin->klas_mesin}}</td>
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
        </thead>
    </table>
</body>
</html>
