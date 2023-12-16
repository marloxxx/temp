@extends('layout.main')
@section('title')
    {{ 'Dashboard - Maintenace' }}
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        @if (Session::has('berhasil'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>Success,</strong>
                {{ Session::get('berhasil') }}
            </div>
        @endif
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <!--
                                                                            @if (auth()->user()->level == 'Admin')
    <div class="col-xl-3 col-md-6 mb-4">
                                                                              <div class="card border-left-primary shadow h-100 py-2">
                                                                                <div class="card-body">
                                                                                  <div class="row no-gutters align-items-center">
                                                                                    <div class="col mr-2">
                                                                                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pegawai</div>
                                                                                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_anggota }} Orang</div>
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>
@else
    @endif
                                                                            -->

            <!-- Total Petugas -->
            @if (auth()->user()->level == 'Admin')
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Petugas
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $jumlah_petugas }}
                                                Petugas</div>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
            @if (auth()->user()->level == 'Admin')
                <!-- Jumlah kategori -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kategori
                                    </div>
                                    <ul>
                                        @foreach ($jumlahKategori as $item)
                                            <li>{{ $item->total }} {{ $item->nama_kategori }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
            @if (auth()->user()->level == 'Admin')
                <!-- Jumlah Klasifikasi -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah
                                        Klasifikasi</div>
                                    <ul>
                                        @foreach ($jumlahKlasifikasi as $item)
                                            <li>{{ $item->total }} {{ $item->nama_klasifikasi }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
            @if (auth()->user()->level == 'Admin')
                <!-- Jumlah Buku -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Mesin
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_mesin }} Mesin</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
            <!-- Total Peminjaman
                                                                            @if (auth()->user()->level == 'Admin')
    <div class="col-xl-3 col-md-6 mb-4">
                                                                              <div class="card border-left-secondary shadow h-100 py-2">
                                                                                <div class="card-body">
                                                                                  <div class="row no-gutters align-items-center">
                                                                                    <div class="col mr-2">
                                                                                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total Peminjaman</div>
                                                                                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_peminjaman }} Data</div>
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>
@else
    @endif
                                                                            -->
            <!-- Total Pengembalian

                                                                            <div class="col-xl-3 col-md-6 mb-4">
                                                                              <div class="card border-left-secondary shadow h-100 py-2">
                                                                                <div class="card-body">
                                                                                  <div class="row no-gutters align-items-center">
                                                                                    <div class="col mr-2">
                                                                                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total Pengembalian</div>
                                                                                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_pengembalian }} Data</div>
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                            -->

            <!-- Total report
                                                                            <div class="col-xl-3 col-md-6 mb-4">
                                                                              <div class="card border-left-secondary shadow h-100 py-2">
                                                                                <div class="card-body">
                                                                                  <div class="row no-gutters align-items-center">
                                                                                    <div class="col mr-2">
                                                                                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">LAPORAN</div>
                                                                                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_pengembalian }} Laporan</div>
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                        -->
            <!-- Total historyrecall
                                                                            <div class="col-xl-3 col-md-6 mb-4">
                                                                              <div class="card border-left-secondary shadow h-100 py-2">
                                                                                <div class="card-body">
                                                                                  <div class="row no-gutters align-items-center">
                                                                                    <div class="col mr-2">
                                                                                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">History Mesin</div>
                                                                                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_pengembalian }} Data</div>
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        -->
            <!-- Approach -->
            @if (auth()->user()->approved == '1')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pesan !!!</h6>
                    </div>
                    <div class="card-body">
                        <p>Selamat datang <b class="text-uppercase ">{{ Auth::user()->nama }}</b></p>
                    </div>
                </div>
            @else
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pesan !!!</h6>
                    </div>
                    <div class="card-body">
                        <p>Selamat datang <b class="text-uppercase ">{{ Auth::user()->nama }}, </b> Akun anda belum bisa
                            digunakan.</p>
                        <p class="mb-0">Silahkan hubungi administrator untuk approval akun."</p>
                    </div>
                </div>
        </div>
    </div>
    @endif
@endsection
