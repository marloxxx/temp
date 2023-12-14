@extends('layouts.app')
@section('title'){{'Register - Penguna Baru'}} @endsection
@section('content')
<div class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5" style="transform: translateY(-90px) ;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <!-- Logo-->
                        <div class="card-header pt-1 pb-1 text-center bg-primary">
                            <a href="/">
                                <span><img src="assets/images/main.png" alt="" height="125"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 fw-bold">Sign Up</h4>
                                <p class="text-muted mb-4">Don't have an account? Create your account here </p>
                            </div>

                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control" id="foto">
                                </div>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Nama<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="fullname" placeholder="Enter your name" required name="nama" value="{{ old('nama') }}" autofocus>
                                    @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nik">NIK<span class="text-danger">*</span></label>
                                    <input type="text" name="nik" class="form-control" id="nik" aria-describedby="nik" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 7)" maxlength="7" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lok_ws" class="form-label">Departemen<span class="text-danger">*</span></label>
                                    <select class="form-select" name="departemen" data-placeholder="Silahkan Pilih" id="single-select-field1">
                                        <option value="" selected disabled>-- Pilih Lokasi Terdaftar --</option>
                                        @foreach ($departemen as $departemen)
                                        <option value="{{ $departemen->nama_departemen }}">{{ $departemen->nama_departemen }}</option>
                                        @endforeach
                                    </select>
                                    @error('lok_ws')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="lok_ws" class="form-label">Plant<span class="text-danger">*</span></label>
                                    <select class="form-select" name="plant" data-placeholder="Silahkan Pilih" id="single-select-field2">
                                        <option value="" selected disabled>-- Pilih Lokasi Terdaftar --</option>
                                        @foreach ($plant as $dataplant)
                                        <option value="{{ $dataplant->nama_plant }}">{{ $dataplant->nama_plant }}</option>
                                        @endforeach
                                    </select>
                                    @error('lok_ws')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" id="emailaddress" required placeholder="Enter your email" name="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                -->

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Ulangi Password<span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password_confirmation">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="Karyawan" name="level">
                                <input type="hidden" value="@php echo date('Y-m-d'); @endphp" name="tanggal_join">
                                <div class="mb-3 text-center">
                                    <button class="btn btn-primary" type="submit"> Sign Up </button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Already have account? <a href="{{ route('login') }}" class="text-muted ms-1"><b>Log In</b></a></p>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        2023 © - Maintenance
    </footer>
</div>
<script>
    $(document).ready(function() {
        $('#single-select-field1').select2({
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
        $('#single-select-field2').select2();
    });

    function displaySelectedImage(event, elementId) {
        const selectedImage = document.getElementById(elementId);
        const fileInput = event.target;

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                selectedImage.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
<style>
    #imagePreview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        position: relative;
    }

    #imagePreview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #imagePreview::before {
        content: '';
        display: block;
        padding-top: 100%;
        /* This creates a square placeholder for the circle */
    }

    #imagePreview img,
    #imagePreview::before {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
    }
</style>
@endsection