@extends('kategori.layout')
<!DOCTYPE html> 
<html> 
<head> 
 	<title>Laporan Data Peminjaman Buku</title> 
</head> 
<body> 
 	<style type="text/css">table tr td, table tr th{ 
 	 	 	font-size: 9pt; 
 	 	} 
 	</style> 
 	<center> 
		<h5>SISTEM INFORMASI MANAJEMEN PERPUSTAKAAN ( SIPUS )</h4> 
 	 	<h5>Hasil Laporan Data Peminjaman Buku</h4> 
 	</center>
	<h6>Tanggal : <?php $tgl=date('d - m - Y');
		echo $tgl; ?></h6> 
 	<table class="table table-bordered 2px" style="text-align:center;">
 	 	<thead> 
 	 	 	<tr> 
 	 	 	 	<th">Id Peminjaman</th> 
                <th">Nama Peminjam</th>
                <th>Nama Buku</th>
                <th">Tanggal Peminjaman</th>
                <th">Lama Peminjaman</th>
                <th>Petugas</th>
                <th>Status</th>
 	 	 	</tr> 
 	 	</thead> 
 	 	<tbody> 
 	 	 	@foreach($peminjaman as $pdf) 
 	 	 	<tr> 
 	 	 	 	<td >{{$pdf->id }}</td> 
                <td>{{$pdf->anggota->nama}}</td>
 	 	 	 	<td>{{$pdf->buku->judul_buku}}</td>
                <td>{{$pdf->tanggal_pinjam}}</td>
                <td>{{$pdf->lama_peminjaman}} Hari</td>
                <td>{{$pdf->user->nama}}</td>
                <td>@if($pdf->status==1)
                        <span class="badge bg-warning text-dark">Dipinjam</span>
                        @else
                        <span class="badge bg-success">Dikembalikan</span>
                        @endif
                </td>
 	 	 	</tr> 
 	 	 	@endforeach 
 	 	</tbody> 
 	</table> 
  
</body> 
</html>