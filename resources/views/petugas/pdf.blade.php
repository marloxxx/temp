@extends('petugas.layout')
<!DOCTYPE html>
<html>

<head>
	<title>Laporan Data</title>
</head>

<body>
	<div class="header">
		<div class="logo">
			<img src="assets/images/laporan/header.png" alt="Logo Laporan">
		</div>
	</div>
	<center>
		<h5>DAFTAR PETUGAS</h4>
			<h5>Laporan Data Petugas</h4>
	</center>

	<table class="table table-bordered 2px" style="text-align:center;">
		<thead>
			<tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama Lengkap</th>
				<th>Jabatan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $pdf)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $pdf->nik }}</td>
				<td>{{$pdf->nama}}</td>
				<td>{{$pdf->level}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>

</html>