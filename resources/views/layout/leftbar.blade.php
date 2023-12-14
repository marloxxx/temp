<head>
    <!-- Lainnya -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezjMWgBtXCg8MRAVvwCsCJz0vE1lcyFJHXlXrbzTWl4JnXDWkYlBOa9tRTaIqegF" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Lainnya -->
    <style>
        .custom-icon {
            display: flex;
            align-items: center;
            gap: 17px;
            /* Sesuaikan jarak antara ikon dan teks sesuai kebutuhan */
        }

        .custom-icon img {
            width: 15px;
            /* Sesuaikan lebar ikon sesuai kebutuhan */
            height: 15px;
            /* Sesuaikan tinggi ikon sesuai kebutuhan */
        }
    </style>
</head>

<div class="leftside-menu">

    <!-- LOGO -->
    <a href="/" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="/assets/images/main2.png" alt="" height="100">
        </span>
    </a>

    <!-- LOGO -->
    <a href="/" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="/assets/images/logo-dark.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="/assets/images/logo_sm_dark.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="/" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                    <br><i class="uil-home-alt" href="/"></i>
                    <span class="badge bg-success float-end" href="/"></span>
                    <span> Home </span>

                </a>


                @auth
                @if(auth()->user()->level=='Admin')
            <li class="side-nav-title side-nav-item">Manajemen Inventaris</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarInventaris" aria-expanded="false" aria-controls="sidebarInventaris" class="side-nav-link">
                    <span class="custom-icon">
                        <img src="{{ asset('assets/images/leftbar/box.png') }}" alt="User Icon" height="15">
                        <span> Inventaris </span>
                        <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarInventaris">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/data-mesin">Data Mesin</a>
                        </li>
                        <li>
                            <a href="/kategori-mesin">Kategori</a>
                        </li>
                        <li>
                            <a href="/klasifikasi-mesin">Klasifikasi</a>
                        </li>
                        <li>
                            <a href="/departemen">Departemen</a>
                        </li>
                        <li>
                            <a href="/plant">Plant</a>
                        </li>
                        <li>
                            <a href="/lokasi-workshop-mesin">Lokasi / User</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @endauth


            <!--PELAPORAN-->
            <li class="side-nav-title side-nav-item">Manajemen Pelaporan</li>
            <!--
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPerbaikan" aria-expanded="false" aria-controls="sidebarPerbaikan" class="side-nav-link">
                    <span class="custom-icon">
                        <img src="{{ asset('assets/images/leftbar/report.png') }}" alt="User Icon" height="15">
                        <span> Perbaikan </span>
                        <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPerbaikan">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="#">Validasi</a>
                        </li>
                        <li>
                            <a href="#">Status</a>
                        </li>
                        <li>
                            <a href="/laporan-perbaikan">Laporan</a>
                        </li>
                        <li>
                            <a href="#">History Perbaikan</a>
                        </li>
                    </ul>
                </div>
            </li>
    -->
            <li class="side-nav-item {{ Request::is('pelaporan/*') ? 'menuitem-active' : '' }}">
                <a data-bs-toggle="collapse" href="#sidebarPelaporan" aria-expanded="false" aria-controls="sidebarPelaporan" class="side-nav-link">
                    <span class="custom-icon">
                        <img src="{{ asset('assets/images/leftbar/report.png') }}" alt="User Icon" height="15">
                        <span> Pelaporan </span>
                        <span class="menu-arrow"></span>
                </a>
                <div class="{{ Request::is('pelaporan/*') ? 'collapse-show' : 'collapse' }}" id="sidebarPelaporan">
                    <ul class="side-nav-second-level">
                        @if(auth()->user()->level=='Admin' || auth()->user()->level=='Petugas' || auth()->user()->level=='Supervisor')
                        <li class="{{ Request::is('pelaporan/masuk*') ? 'active' : '' }}">
                            <a href="/pelaporan/masuk">Pelaporan Masuk</a>
                        </li>
                        @endif

                        @if(auth()->user()->level=='Karyawan')
                        <li class="{{ Request::is('pelaporan/tambah*') ? 'active' : '' }}">
                            <a href="/pelaporan/tambah">Tambah Laporan</a>
                        </li>
                        <li class="{{ Request::is('pelaporan/cek*') ? 'active' : '' }}">
                            <a href="/pelaporan/cek">Cek Perbaikan</a>
                        </li>
                        @endif

                        <li class="{{ Request::is('pelaporan/selesai*') ? 'active' : '' }}">
                            <a href="/pelaporan/selesai">Pelaporan Selesai</a>
                        </li>
                    </ul>
                </div>
            </li>



            <!--PENGGUNA-->
            @auth
            @if(auth()->user()->level=='Admin')
            <li class="side-nav-title side-nav-item">Manajemen Pengguna</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarpenguna" aria-expanded="false" aria-controls="sidebarpenguna" class="side-nav-link">
                    <span class="custom-icon">
                        <img src="{{ asset('assets/images/leftbar/user.png') }}" alt="User Icon" height="15">
                        <span> Pengguna </span>
                        <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarpenguna">
                    <ul class="side-nav-second-level">
                        <!--
        <li>
            <a href="/pegawai">Data Pegawai</a>
        </li>
        -->
                        <li>
                            <a href="/datapetugas">Data Petugas</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @endauth


            <!-- End Sidebar -->

            <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>