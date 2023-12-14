@extends('kategori.layout')
<!DOCTYPE html> 
<html> 
<head> 
 	<title>Laporan Data Kategori Buku</title> 
</head> 
<body> 
 	<style type="text/css">table tr td, table tr th{ 
 	 	 	font-size: 9pt; 
 	 	} 
 	</style> 
 	<center> 
		<h5>SISTEM INFORMASI MANAJEMEN PERPUSTAKAAN ( SIPUS )</h4> 
 	 	<h5>Hasil Laporan Data Kategori Buku</h4> 
 	</center>
	<h6>Tanggal : <?php $tgl=date('d - m - Y');
		echo $tgl; ?></h6> 
 	<table class="table table-bordered 2px">
 	 	<thead> 
 	 	 	<tr> 
 	 	 	 	<th>Id Kategori</th> 
 	 	 	 	<th>Nama Kategori</th> 
                <th>Deskripsi</th>
 	 	 	</tr> 
 	 	</thead> 
 	 	<tbody> 
 	 	 	@foreach($data_kategoris as $pdf) 
 	 	 	<tr> 
 	 	 	 	<td>{{$pdf->id }}</td> 
 	 	 	 	<td>{{$pdf->nama_kategori}}</td> 
 	 	 	 	<td>{{$pdf->deskripsi}}</td> 
 	 	 	</tr> 
 	 	 	@endforeach 
 	 	</tbody> 
 	</table> 
  
</body> 
</html>