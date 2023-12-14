@extends('kategori.layout')
<!DOCTYPE html> 
<html> 
<head> 
 	<title>Laporan Data Pengembalian Buku</title> 
</head> 
<body> 
 	<style type="text/css">table tr td, table tr th{ 
 	 	 	font-size: 9pt; 
 	 	} 
 	</style> 
 	<center> 
		<h5>SISTEM INFORMASI MANAJEMEN PERPUSTAKAAN ( SIPUS )</h4> 
 	 	<h5>Hasil Laporan Data Pengembalian Buku</h4> 
 	</center>
	<h6>Tanggal : <?php $tgl=date('d - m - Y');
		echo $tgl; ?></h6> 
 	<table class="table table-bordered 2px" style="text-align:center;">
 	 	<thead> 
 	 	 	<tr> 
 	 	 	 	<th>Id Pengembalian</th> 
                <th>Nama Peminjam</th>
                <th>Nama Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Petugas</th>
                <th>Status</th>
                <th>Denda</th>
 	 	 	</tr> 
 	 	</thead> 
 	 	<tbody> 
 	 	 	@foreach($pengembalians as $pdf) 
 	 	 	<tr> 
 	 	 	 	<td >{{$pdf->id }}</td> 
                <td>{{$pdf->peminjaman->anggota->nama}}</td>
 	 	 	 	<td>{{$pdf->peminjaman->buku->judul_buku}}</td>
                <td>{{$pdf->peminjaman->tanggal_pinjam}}</td>
                <td>{{$pdf->tanggal_kembali}} Hari</td>
                <td>{{$pdf->peminjaman->user->nama}}</td>
                <td>@if($pdf->peminjaman->status==1)
                        <span class="badge bg-warning text-dark">Dipinjam</span>
                        @else
                        <span class="badge bg-success">Dikembalikan</span>
                        @endif
                    </td>
                    <td>@if($pdf->denda)
                        Rp. {{number_format($pdf->denda)}}
                        @else
                        -
                        @endif</td>
 	 	 	</tr> 
 	 	 	@endforeach 
 	 	</tbody> 
 	</table> 
  
</body> 
</html>