<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Barang</title>
    <link rel="icon" type="image/png" href="{{url('logo/logo.png')}}">
    <style>
        .logo {
            margin-top: 15px;
            float: left;
            width: 17%;
            padding: 0px;
            text-align: right;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid;
            padding-left: 5px;
            text-align: center;
        }

        .judul {
            text-align: center;
        }

        .headtext {
            float: right;
            margin-left: 0px;
            width: 75%;
            padding-left: 0px;
            padding-right: 10%;
        }

        .ttd {
            margin-left: 70%;
            text-align: center;
            text-transform: uppercase;
        }

        .sizeimg {
            width: 100px;
        }

        .headtext {
            float: right;
            margin-left: 0px;
            width: 75%;
            padding-left: 0px;
            padding-right: 10%;
        }

        .header {
            margin-bottom: 0px;
            text-align: center;
            height: 150px;
            padding: 0px;
        }

        .ttd {
            margin-left: 70%;
            text-align: center;
            text-transform: uppercase;
        }

        hr {
            margin-top: 10%;
            height: 3px;
            background-color: black;
        }

        br {
            margin-bottom: 5px !important;
        }

        h5 {
            line-height: 0.3;
        }
    </style>
</head>

<body>

    < class="container" style="margin-top:-40px;">
        <h3 style="text-align:center;text-transform: uppercase;">Daftar Karyawan</h3>
        <table class="table table-bordered nowrap">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">NIK</th>
                    <th scope="col" class="text-center">Nama lengkap</th>
                    <th scope="col" class="text-center">Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_anggotas as $pdf)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$pdf->nik}}</td>
                    <td>{{$pdf->nama}}</td>
                    <td>{{$pdf->jabatan}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
</body>

</html>