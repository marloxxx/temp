@extends('layout.main')

@section('content')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2>Edit Data Mesin</h2>
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
                        <form method="post" action="/data-mesin/{{ $datamesin->id }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="kode_jenis" class="form-label">Nomor</label>
                                <input type="text" name="kode_jenis"
                                    class="form-control @error('kode_jenis') is-invalid @enderror" id="kode_jenis"
                                    placeholder="Masukkan nama jenis baru.." maxlength="10" readonly
                                    value="{{ $datamesin->kode_jenis }}">
                                @error('nama_mesin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="nama_mesin" class="form-label">Nama Mesin</label>
                                    <input type="text" name="nama_mesin" class="form-control" id="nama_mesin"
                                        value="{{ $datamesin->nama_mesin }}">
                                </div>
                                <div class="col">
                                    <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input type="text" name="kapasitas" class="form-control" id="kapasitas"
                                        placeholder="Masukan Kapasitas Bulanan" value="{{ $datamesin->kapasitas }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="kategori" class="form-label">Kategori Mesin<span
                                            class="text-danger">*</label>
                                    <select id="single-select-field" name="kategori" class="form-control">
                                        <option value="{{ $datamesin->nama_kategori }}">-- Select Kategori --</option>
                                        @foreach ($kategorimesin as $data)
                                            <option value="{{ $data->id }}" data-id="{{ $data->id }}"
                                                data-kode-kategori="{{ $data->kode_kategori }}"
                                                {{ $datamesin->kode_kategori == $data->id ? 'selected' : '' }}>
                                                {{ $data->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="klasifikasi" class="form-label">Klasifikasi Mesin<span
                                            class="text-danger">*</label>
                                    <select id="single-select-field2" name="klasifikasi" class="form-control">
                                        <option value="">-- Select Klasifikasi --</option>
                                        @if ($datamesin->klasmesin)
                                            <option value="{{ $datamesin->klasmesin->id }}" selected>
                                                {{ $datamesin->klasmesin->nama_klasifikasi }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="type_mesin" class="form-label">Type</label>
                                    <input type="text" name="type_mesin" class="form-control" id="type_mesin"
                                        value="{{ $datamesin->type_mesin }}">
                                </div>
                                <div class="col">
                                    <label for="merk_mesin" class="form-label">Merk</label>
                                    <input type="text" name="merk_mesin" class="form-control" id="merk_mesin"
                                        value="{{ $datamesin->merk_mesin }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="spek_mesin" class="form-label">Spesifikasi:</label>
                                <div class="col">
                                    <label class="text-primary" for="spek_min">Min.</label>
                                    <input type="text" name="spek_min" class="form-control" id="spek_min"
                                        placeholder="Masukan Minimal" value="{{ $datamesin->spek_min }}">
                                </div>
                                <div class="col">
                                    <label class="text-primary" for="spek_max">Max.</label>
                                    <input type="text" name="spek_max" class="form-control" id="spek_max"
                                        placeholder="Masukan maximal" value="{{ $datamesin->spek_max }}">
                                </div>

                            </div>

                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="pabrik" class="form-label">Pabrikan</label>
                                    <input type="text" name="pabrik" class="form-control" id="pabrik"
                                        placeholder="Masukan Negara Pembuat" value="{{ $datamesin->pabrik }}">
                                </div>
                                <div class="col">
                                    <label for="tahun_mesin" class="form-label">Tahun Mesin</label>
                                    <input type="text" name="tahun_mesin" class="form-control" id="tahun_mesin"
                                        value="{{ $datamesin->tahun_mesin }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                </div>
                            </div>
                            @error('tahun_mesin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="lok_ws" class="form-label">Lokasi</label>
                                    <select class="form-select" name="lok_ws" id="single-select-field3" required>
                                        @foreach ($workshop as $kategori)
                                            <option value="{{ $kategori->nama_workshop }}">{{ $kategori->nama_workshop }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="gambar_mesin" class="form-label">Gambar Mesin</label>
                                    <input type="file" name="gambar_mesin" class="form-control" id="gambar_mesin">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a class="btn btn-success" href="/data-mesin">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#single-select-field').select2();
            $('#single-select-field2').select2();
            $('#single-select-field3').select2({
                matcher: function(params, data) {
                    // Jika pencarian kosong, tampilkan semua opsi
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    // Ubah teks opsi dan kata kunci pencarian ke huruf kecil untuk pencarian yang tidak bersifat case-sensitive
                    var text = data.text.toLowerCase();
                    var term = params.term.toLowerCase();

                    // Cek apakah dua huruf dari kata kunci muncul dalam teks opsi secara berurutan
                    var termChars = term.split('');
                    var termLength = termChars.length;
                    var lastMatchedIndex = -1;

                    for (var i = 0; i < termLength; i++) {
                        var char = termChars[i];
                        var indexInText = text.indexOf(char, lastMatchedIndex + 1);

                        if (indexInText === -1) {
                            return null; // Jika satu huruf tidak ditemukan, kembalikan null
                        }

                        lastMatchedIndex = indexInText;
                    }

                    // Jika semua huruf ditemukan secara berurutan, kembalikan data
                    return data;
                }
            });
        });

        window.addEventListener('load', function() {
            var kodeKategori = $('#single-select-field').find(':selected').attr('data-kode-kategori');
            var idCountry = $('#single-select-field').find(':selected').data('id');
            if (idCountry) {
                $.ajax({
                    url: "{{ url('api/getklasmesin') }}",
                    type: "POST",
                    data: {
                        kategorimesin_id: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#single-select-field2').html(
                            '<option value="">-- Select Klasifikasi --</option>');
                        $.each(result.klasmesin, function(key, value) {
                            // Pastikan atribut data-kode-klasifikasi ada dan terisi dengan benar
                            var kodeKlasifikasi = value.kode_klasifikasi ? value
                                .kode_klasifikasi :
                                '';
                            if ('{{ $datamesin->kode_klasifikasi }}' == value.id) {
                                $("#single-select-field2").append(
                                    '<option selected value="' + value
                                    .id + '" data-kode-klasifikasi="' +
                                    kodeKlasifikasi + '">' +
                                    value.nama_klasifikasi + '</option>');
                            } else {
                                $("#single-select-field2").append('<option value="' +
                                    value.id +
                                    '" data-kode-klasifikasi="' + kodeKlasifikasi +
                                    '">' + value
                                    .nama_klasifikasi + '</option>');
                            }

                        });

                        // Panggil fungsi getLatestID saat dropdown klasifikasi berubah
                        getLatestID();
                    }
                });
            }

            // Panggil fungsi getLatestID saat dropdown klasifikasi berubah
            $('#single-select-field2').on('change', function() {
                getLatestID();
            });


            function getLatestID() {
                var selectedKategoriId = $('#single-select-field').val();
                var selectedKlasifikasiId = $('#single-select-field2').val();

                $.ajax({
                    url: "/get-latest-id/" + selectedKategoriId + "/" + selectedKlasifikasiId,
                    method: "GET",
                    success: function(response) {
                        var latestID = response.latestID;
                        updateKodeJenis(latestID);
                    },
                    error: function(xhr, status, error) {
                        console.error('Gagal mengambil ID terbaru: ' + error);
                    }
                });
            }

            function updateKodeJenis(latestID) {
                var selectedKategori = $('#single-select-field');
                var selectedKlasifikasi = $('#single-select-field2');
                var tahunMesin = $('#tahun_mesin').val();
                if (tahunMesin == '') {
                    tahunMesin = '0000';
                }
                var kodeKategori = selectedKategori.find(':selected').attr('data-kode-kategori');
                var kodeKlasifikasi = selectedKlasifikasi.find(':selected').attr('data-kode-klasifikasi');

                // Format kodeJenis sesuai kebutuhan Anda
                // var nomorUrut = ('000' + latestID).slice(-3);
                var kodeJenis = kodeKategori + ' - ' + kodeKlasifikasi + ' - ' + ' - ' + tahunMesin;
                $('#kode_jenis').val(kodeJenis);

                // Format kodeJenis sesuai kebutuhan Anda
                $.ajax({
                    url: "/get-latest-mesin/" + selectedKategori.val() + "/" + selectedKlasifikasi.val() +
                        "/" + tahunMesin,
                    method: "GET",
                    success: function(response) {

                        if (response.latest == '') {
                            // var nomorUrut = ('000' + latestID).slice(-3);
                            var kodeJenis = kodeKategori + ' - ' + kodeKlasifikasi + ' - ' + '001' +
                                ' - ' + tahunMesin;
                            $('#kode_jenis').val(kodeJenis);
                        } else {
                            console.log('====================================');
                            console.log(response.latest);
                            console.log('====================================');

                            var inputString = response.latest;
                            var nextNomorUrut = incrementNomorUrut(inputString);

                            // Membuat string baru dengan nomor urut yang telah diincrement
                            var newString = inputString.replace(/(\d{3})/, nextNomorUrut);

                            var kodeJenis = kodeKategori + ' - ' + kodeKlasifikasi + ' - ' +
                                nextNomorUrut + ' - ' + tahunMesin;
                            $('#kode_jenis').val(kodeJenis);

                        }
                    },
                });
            }

            getLatestID();
        });
    </script>

@endsection
