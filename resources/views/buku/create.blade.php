@extends('layout.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2>Tambah Data Mesin</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Terdapat beberapa masalah pada input Anda:<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="/datamesin" id="myForm" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="no_mesin" class="form-label">No. Registrasi</label>
                            <input type="text" name="no_mesin" class="form-control" id="no_mesin" oninput="formatNoRegistrasi(this)">
                        </div>
                        <script>
                            function formatNoRegistrasi(input) {
                                // Menghapus semua karakter "-" dan spasi dari input
                                let value = input.value.replace(/[-\s]/g, '');
                                // Membagi nilai menjadi blok 4 karakter
                                let formattedValue = value.match(/.{1,4}/g);
                                // Menggabungkan blok dengan "-" atau spasi
                                if (formattedValue) {
                                    formattedValue = formattedValue.join('-');
                                    input.value = formattedValue;
                                }
                            }
                        </script>

                        <div class="mb-3">
                            <label for="nama_mesin" class="form-label">Nama Mesin</label>
                            <input type="text" name="nama_mesin" class="form-control" id="nama_mesin">
                        </div>

                        <div class="mb-3">
                            <label for="data_kategori_id" class="form-label">Nama Kategori</label>
                            <select class="form-select" name="data_kategori_id" id="data_kategori_id">
                                @foreach ($data_kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="book_image" class="form-label">Gambar Mesin</label>
                            <input type="file" name="book_image" class="form-control" id="book_image">
                        </div>

                        <div class="mb-3">
                            <label for="spek" class="form-label">Spesifikasi</label>
                            <input type="text" name="spek" class="form-control" id="spek">
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" id="jumlah">
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Di Input Oleh</label>
                            <select class="form-select" name="user_id" id="user_id">
                                @foreach ($users as $petugas)
                                <option value="{{ $petugas->id }}">{{ $petugas->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-success" href="/datamesin">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection