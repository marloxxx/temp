@extends('layout.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle user_picture" src="{{ asset('storage/' . $user->foto) }}" alt="User profile picture">
                        </div>

                        <input type="file" name="foto" class="form-control-file" id="foto" aria-describedby="foto">
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#" data-toggle="tab">Informasi Pribadi</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('akun.update', $user) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Nama Lengkap" name="nama" value="{{ $user->nama }}">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputNik" placeholder="Masukan NIK" name="nik" value="{{ $user->nik }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-success" href="/datapetugas">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#single-select-field1').select2();
        $('#single-select-field2').select2();
    });
</script>
@include('sweetalert::alert')
@endsection