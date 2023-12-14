@extends('buku.layout')
<!DOCTYPE html>
<html>

<head>
	<title>fatar mesin</title>
</head>

<body>
	<style type="text/css">
		table tr td,
		table tr th {
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>DAFTAR MESIN MAINTENACE</h4>
			<h5>Sub Judul</h4>
	</center>
	<h6>Tanggal : <?php $tgl = date('d - m - Y');
					echo $tgl; ?></h6>
	<table class="table table-bordered 2px">
		<thead>
			<tr>
				<th>No.</th>
				<th>Id Registrasi</th>
				<th>Nama Mesin</th>
				<th>Kategori</th>
				<th>Spesifikasi</th>
				<th>Jumlah</th>
				<th>Diinput Oleh</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data_bukus as $pdf)
			<tr>
				<td>{{$pdf->id }}</td>
				<td>{{$pdf->no_mesin }}</td>
				<td>{{$pdf->nama_mesin}}</td>
				<td>{{$pdf->data_kategori->nama_kategori}}</td>
				<td>{{$pdf->spek}}</td>
				<td>{{$pdf->jumlah}}</td>
				<td>{{$pdf->user->nama}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>

</html>