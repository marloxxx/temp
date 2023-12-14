@extends('layout.main')
@section('title', 'Daftar Spesifikasi Mesin')
@section('content')
<div class="content-container text-center">
    <h1 class="h3 mb-2 text-gray-800">Data Mesin</h1>
    <p class="mb-4">Berikut merupakan data Mesin di Maintenance</p>
</div>


@if(Session::has('berhasil'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Success,</strong>
    {{ Session::get('berhasil') }}
</div>
@endif
<div class="row px-3 py-3">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="data-mesin-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Mesin</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($datamesin as $mesin)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-capitalize"><a href="/spesifikasi-mesin/{{ $mesin->id }}">{{ $mesin->nama_mesin }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>


<script>
    $(document).ready(function() {
        $('#data-mesin-table').DataTable({
            "order": [
                [0, 'asc']
            ], // Mengurutkan kolom pertama (No.) secara ascending
            "searching": true, // Mengaktifkan pencarian
            "paging": true, // Mengaktifkan pagination
            "pageLength": 10, // Jumlah baris yang ditampilkan per halaman
            "lengthChange": false, // Menyembunyikan opsi perubahan jumlah baris per halaman
            "info": true, // Menampilkan informasi halaman dan jumlah total data
            "responsive": true, // Membuat tabel responsif
            "columnDefs": [{
                    "width": "10px",
                    "targets": 0
                } // Mengatur lebar kolom pertama (No.)
            ]
        });
    });
</script>


<style>
    .action-buttons {
        display: flex;
        align-items: center;
    }

    .action-buttons form {
        margin-right: 10px;
    }

    .qrcode-button {
        display: inline-block;
        padding: 5px;
        background-color: #ECEE81;
        margin-left: -6px;
    }


    .content-container {
        margin-top: 60px;
        /* Sesuaikan nilai margin-top sesuai kebutuhan Anda */
    }

    /* Custom styles for all modals */
    .modal {
        background: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background-color: #007bff;
        color: #ffffff;
        border-bottom: 1px solid #dee2e6;
    }

    .modal-title {
        font-weight: bold;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        border-top: 1px solid #dee2e6;
        padding: 15px;
    }

    .close {
        font-size: 1.5rem;
        font-weight: bold;
        line-height: 1;
        color: #00000;
        opacity: 0.75;
    }

    /* Styling for the buttons in the footer */
    .modal-footer .btn {
        margin-right: 10px;
    }




    /* Style for the table */
    .table.table-bordered thead th {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table.table-bordered tbody td {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* Adjust column widths */
    .table.table-bordered th:nth-child(1),
    .table.table-bordered td:nth-child(1) {
        width: 10%;
    }

    .table.table-bordered th:nth-child(2),
    .table.table-bordered td:nth-child(2) {
        width: 10%;
    }

    .table.table-bordered th:nth-child(3),
    .table.table-bordered td:nth-child(3) {
        width: 15%;
    }

    .table.table-bordered th:nth-child(4),
    .table.table-bordered td:nth-child(4) {
        width: 8%;
    }

    .table.table-bordered th:nth-child(5),
    .table.table-bordered td:nth-child(5) {
        width: 10%;
    }

    .table.table-bordered th:nth-child(6),
    .table.table-bordered td:nth-child(6) {
        width: 12%;
    }

    .table.table-bordered th:nth-child(7),
    .table.table-bordered td:nth-child(7) {
        width: 10%;
    }

    .table.table-bordered th:nth-child(8),
    .table.table-bordered td:nth-child(8) {
        width: 5%;
    }

    .table.table-bordered th:nth-child(9),
    .table.table-bordered td:nth-child(9) {
        width: 5%;
    }

    .table.table-bordered th:nth-child(10),
    .table.table-bordered td:nth-child(10) {
        width: 10%;
    }
</style>
@include('sweetalert::alert')
@endsection