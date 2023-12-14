@extends('layouts.app')

@section('title'){{'Login - Sipus'}} @endsection

@section('content')
<div class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5" style="transform: translateY(-70px) ;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-1 pb-1 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="assets/images/main.png" alt="" height="125"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Masuk</h4>
                                <p class="text-muted mb-4">Silahkan masukkan email dan password untuk mengakses sistem
                                </p>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">NIK</label>
                                    <input class="form-control" type="nik" id="emailaddress" required="" placeholder="Masukkan NIK" name="nik" value="{{ old('nik') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 7)" maxlength="7" required>
                                    @error('nik')
                                    <a class="alert alert-danger" role="alert">
                                        <strong>Email/Password Yang Anda Masukkan Salah!</strong>
                                    </a>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Sandi</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        @error ('password')
                                        <span class="alert alert-danger" role="alert">
                                            <strong>Password Yang Anda Masukkan Salah!</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                    <a href="/register" class="btn btn-primary"> Register</a>

                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <footer class="footer footer-alt">
                        2023 © - Maintenace
                    </footer>
                </div>
                @include('sweetalert::alert')
                @endsection