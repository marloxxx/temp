@extends('anggota.layout')
<!DOCTYPE html>
<html>

<head>
	<title>Laporan Data Pegawai</title>
</head>

<body>
	<style type="text/css">
		table tr td,
		table tr th {
			font-size: 5pt;
		}
	</style>
	<center>
		<img src="path_to_left_logo.png" style="float: left;">
		<h5>DAFTAR PEGAWAI TERDAFTAR</h4>
			<h5>REKAP LIST PENGAWAI </h4>
				<img src="path_to_right_logo.png" style="float: right;">
	</center>
	<h6>Tanggal : <?php $tgl = date('d - m - Y');
					echo $tgl; ?></h6>
	<table class="table table-bordered 2px" style="text-align:center;">
		<thead>
			<tr>
				<th>No.</th>
				<th>NIK</th>
				<th>NAME/NAMA</th>
				<th>Bagian / Jabatan</th>
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

</body>

</html>