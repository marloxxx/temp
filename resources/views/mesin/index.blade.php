@extends('layout.main')
@section('title', 'Daftar Mesin')
@push('styles')
    <style>
        /* Filter Dropdown Styles */
        .filter-dropdown {
            width: auto;
            /* Set width to auto to match column width */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        /* Adjust the position of the pseudo-element */
        .filter-column:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 100%;
            /* Set height to 100% */
            background-color: white;
            z-index: -1;
        }

        /* Reset Button Styles */
        #resetFilterBtn {
            padding: 8px;
            background-color: #00FF00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #resetFilterBtn:hover {
            background-color: #FF0000;
        }

        .dataTables_filter input {
            width: 300px;
            /* Sesuaikan dengan lebar yang diinginkan */
            height: 30px;
            /* Sesuaikan dengan tinggi yang diinginkan */
            border-radius: 5px;
            /* Tambahkan border radius */
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
@endpush
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Data Mesin</h1>
        <p class="mb-4">Berikut merupakan data Mesin di Maintenance</p>

        @if (Session::has('berhasil'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Success,</strong>
                {{ Session::get('berhasil') }}
            </div>
        @endif
        <div class="row justify-content-start">
            <div class="d-flex justify-content-start">
                <a href="/data-mesin/create" class="btn btn-primary btn-icon-split btn-sm mb-3" id="addRowButton">Tambah
                    Data Mesin</a>

                <!--
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a href="/data-mesin/printpdf" class="btn btn-success btn-icon-split btn-sm mb-3">Print Data Mesin</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                -->
                <button type="button" class="btn btn-success btn-icon-split btn-sm mb-3" data-toggle="modal"
                    data-target="#importModal">IMPORT</button>
                <a href="#" class="btn btn-success btn-icon-split btn-sm mb-3" data-toggle="modal"
                    data-target="#exportModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-download"></i>
                    </span>
                    <span class="text">EXPORT</span>
                </a>
                <button type="button" class="btn btn-success btn btn-danger btn-sm mb-3" data-toggle="modal"
                    data-target="#resetModal">
                    Reset
                </button>
            </div>
            <!-- search filter -->
            <div class="d-flex justify-content-end">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Data Mesin" aria-label="Cari Data Mesin"
                        name="search" />
                </div>
            </div>
        </div>
        <!-- Import Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="importFile">Choose file</label>
                                <input type="file" name="file" class="form-control-file" id="importFile">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Konfirmasi Reset -->
        <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resetModalLabel">Konfirmasi Reset Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin mereset data pada tabel datamesin? Tindakan ini tidak dapat dipulihkan.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <!-- Tombol untuk melakukan reset -->
                        <form action="{{ route('reset.datamesin') }}" method="post" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reset Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Konfirmasi Export -->
        <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exportModalLabel">Konfirmasi Export Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin melakukan ekport data? Klik Export.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <!-- Tautan untuk melakukan eksport -->
                        <a href="{{ route('file-export') }}" class="btn btn-success">EXPORT</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row px-3 py-3">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="datatable7">
                        <thead>
                            <tr>
                                <th>
                                    <button id="resetFilterBtn" class="filter-dropdown">Reset</button>
                                </th>
                                <th>

                                </th>
                                <th>
                                    <div id="noRegistrasiFilter" class="filter-dropdown"></div>
                                </th>
                                <th>

                                    <div id="kategoriFilter" class="filter-dropdown"></div>

                                </th>
                                <th>

                                    <div id="klasifikasiFilter" class="filter-dropdown"></div>

                                </th>
                                <th>
                                    <div id="NamaMesinFilter" class="filter-dropdown"></div>
                                </th>
                                <th>
                                    <div id="TypeFilter" class="filter-dropdown"></div>
                                </th>
                                <th>
                                    <div id="MerkFilter" class="filter-dropdown"></div>
                                </th>
                                <th>
                                    <div id="SpekFilter" class="filter-dropdown"></div>
                                </th>
                                <th>
                                    <div id="PabrikFilter" class="filter-dropdown"></div>
                                </th>
                                <th>
                                    <div id="KapasitasFilter" class="filter-dropdown"></div>
                                </th>
                                <th>
                                    <div id="TahunFilter" class="filter-dropdown"></div>
                                </th>
                                <th>
                                    <div id="LokasiFilter" class="filter-dropdown"></div>
                                </th>
                            </tr>
                            <tr>
                                <th>Ubah</th>
                                <th>No.</th>
                                <th>No.Registrasi</th>
                                <th>Katgeori Mesin</th>
                                <th>Klasifikasi Mesin</th>
                                <th>Nama Mesin</th>
                                <th>Type</th>
                                <th>Merk</th>
                                <th>Spesifikasi</th>
                                <th>Pabrikan</th>
                                <th>Kapasitas</th>
                                <th>Tahun Mesin</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>

    {{-- <!-- DataTables Select CSS -->
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">

        <!-- DataTables Select JavaScript -->
        <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            var table = $('#datatable7').DataTable({
                "processing": true,
                "serverSide": true,
                ajax: {
                    url: "{{ route('mesin.data') }}",
                    type: 'GET'
                },
                "columns": [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a class="btn btn-info" href="/data-mesin/' + row.id +
                                '"><i class="bi bi-eye"></i></a>' +
                                '<a class="btn btn-primary" href="/data-mesin/' + row.id +
                                '/edit"><i class="bi bi-pencil-square"></i></a>' +
                                '<form action="/data-mesin/' + row.id +
                                '" method="POST" style="display:inline; margin-right: 10px;">' +
                                '@csrf' +
                                '@method('DELETE')' +
                                '<button onclick="return confirm(\'Apakah Anda Yakin Ingin Menghapus Data Ini?\')" class="btn btn-danger"><i class="bi bi-trash"></i></button>' +
                                '</form>' +
                                '<a class="btn btn-info" href="/qrcode/' + row.kode_jenis +
                                '" style="display: inline-block; padding: 5px; background-color: #ECEE81; margin-left: -6px;">' +
                                '<img src="{{ asset('assets/icon/qrcode-solid.svg') }}" alt="Lihat" style="width: 34px; height: 27px;">' +
                                '</a>';
                        }
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_jenis',
                        name: 'kode_jenis',
                        searchable: true
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori',
                        searchable: true
                    },
                    {
                        data: 'nama_klasifikasi',
                        name: 'nama_klasifikasi',
                        searchable: true
                    },
                    {
                        data: 'nama_mesin',
                        name: 'nama_mesin',
                        searchable: true
                    },
                    {
                        data: 'type_mesin',
                        name: 'type_mesin',
                        searchable: true
                    },
                    {
                        data: 'merk_mesin',
                        name: 'merk_mesin',
                        searchable: true
                    },
                    {
                        data: 'spek_min',
                        name: 'spek_min',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pabrik',
                        name: 'pabrik',
                        searchable: false
                    },
                    {
                        data: 'kapasitas',
                        name: 'kapasitas',
                        searchable: false
                    },
                    {
                        data: 'tahun_mesin',
                        name: 'tahun_mesin',
                        searchable: true
                    },
                    {
                        data: 'lok_ws',
                        name: 'lok_ws',
                        searchable: true
                    },
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    'copy', 'excel', 'pdf', 'print'
                ],
                "columnDefs": [{
                        "width": "10%",
                        "targets": 0
                    },
                    {
                        "width": "5%",
                        "targets": 1
                    },
                    {
                        "width": "10%",
                        "targets": 2
                    },
                    {
                        "width": "15%",
                        "targets": 3
                    },
                    {
                        "width": "8%",
                        "targets": 4
                    },
                    {
                        "width": "10%",
                        "targets": 5
                    },
                    {
                        "width": "12%",
                        "targets": 6
                    },
                    {
                        "width": "10%",
                        "targets": 7
                    },
                    {
                        "width": "5%",
                        "targets": 8
                    },
                    {
                        "width": "5%",
                        "targets": 9
                    },
                    {
                        "width": "10%",
                        "targets": 10
                    }
                ],
                "initComplete": function() {
                    var columnNoUrut = this.api().column(1);
                    createFilterDropdown(columnNoUrut, '#NoUrutFilter');
                    var columnNoRegistrasi = this.api().column(2);
                    createFilterDropdown(columnNoRegistrasi, '#noRegistrasiFilter');

                    var columnKategori = this.api().column(3);
                    createFilterDropdown(columnKategori, '#kategoriFilter');

                    var columnKlasifikasi = this.api().column(4);
                    createFilterDropdown(columnKlasifikasi, '#klasifikasiFilter');

                    var columnNamaMesin = this.api().column(5);
                    createFilterDropdown(columnNamaMesin, '#NamaMesinFilter');

                    var columnType = this.api().column(6);
                    createFilterDropdown(columnType, '#TypeFilter');

                    var columnMerk = this.api().column(7);
                    createFilterDropdown(columnMerk, '#MerkFilter');

                    var columnSpek = this.api().column(8);
                    createFilterDropdown(columnSpek, '#SpekFilter');

                    var columnPabrik = this.api().column(9);
                    createFilterDropdown(columnPabrik, '#PabrikFilter');

                    var columnKapasitas = this.api().column(10);
                    createFilterDropdown(columnKapasitas, '#KapasitasFilter');

                    var columnTahun = this.api().column(11);
                    createFilterDropdown(columnTahun, '#TahunFilter');

                    var columnLokasi = this.api().column(12);
                    createFilterDropdown(columnLokasi, '#LokasiFilter');
                }
            });

            function createFilterDropdown(column, containerId) {
                var container = $(containerId);
                var select = $('<select><option value="">--Silahkan Pilih--</option></select>')
                    .appendTo(container)
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>');
                });
            }

            $('#resetFilterBtn').on('click', function() {
                table.columns().search('').draw();
            });

            // Fungsi konfirmasi hapus dengan modal
            function confirmDelete(id) {
                // Gantilah 'deleteModal' dengan ID modal konfirmasi Anda
                $('#deleteModal').modal('show');

                // Setelah konfirmasi, panggil fungsi untuk menghapus data
                $('#confirmDeleteButton').on('click', function() {
                    deleteData(id);
                });
            }

            // Fungsi hapus data (gantilah dengan logika penghapusan data Anda)
            function deleteData(id) {
                $.ajax({
                    url: '/data-mesin/' + id,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Gantilah ini dengan logika yang sesuai setelah penghapusan data berhasil
                        console.log('Data berhasil dihapus');
                        // Tutup modal setelah penghapusan
                        $('#deleteModal').modal('hide');
                    },
                    error: function(error) {
                        console.error('Terjadi kesalahan saat menghapus data:', error);
                        // Tutup modal dalam kasus kesalahan
                        $('#deleteModal').modal('hide');
                    }
                });
            }
        });
    </script>
@endsection
