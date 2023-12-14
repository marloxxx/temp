@extends('layout.main')
@section('title'){{'Data Petugas'}} @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  @if(auth()->user()->level=='Admin')
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Petugas</h1>
  <p class="mb-4">Berikut merupakan data Petugas perpustakaan</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <a href="/datapetugas/create" class="btn mb-3 btn-primary btn-icon-split btn-sm">Tambah Data Petugas</a>
      <a href="/petugas/pdf" class="btn mb-3 btn-success btn-icon-split btn-sm">Print Data</a>

      <div class="row px-3 py-3">
        <div class="col-lg-12">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="datatable5">
              <thead>
                <tr>
                  <th>Ubah</th>
                  <th>No.</th>
                  <th>Disetujui</th>
                  <th>Nama Lengkap</th>
                  <th>NIK</th>
                  <th>Departemen</th>
                  <th>Plant</th>
                  <th>Tanggal Aktif</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($post as $user)
                <tr>
                  <td style="text-align:left;">
                    <a class="btn btn-primary" href="/datapetugas/{{$user->nama}}/edit"><i class="bi bi-pencil-square"></i></a>
                    <form action="/datapetugas/{{$user->id}}" method="POST">@csrf
                      @method('DELETE')
                      <button onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini? ')" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                    <a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a>
                  </td>
                  <td>{{$loop->iteration}}</td>
                  <td>
                    <button type="button" class="btn btn-{{ $user->approved ? 'success' : 'danger' }}" data-toggle="modal" data-target="#approveModal{{ $user->id }}">
                      {{ $user->approved ? 'Approved' : 'Unapproved' }}
                    </button>
                  </td>

                  <!-- Modal -->
                  <div class="modal fade" id="approveModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="approveModalLabel{{ $user->id }}">Ubah Approval Status</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah Yakin Mengubah Status <strong>{{ $user->nama }}</strong>?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <form id="approveForm{{ $user->id }}" action="" method="post" onsubmit="return reloadModal('{{ $user->id }}', {{ $user->approved }}, '{{ route('users.approve', $user) }}', '{{ route('users.unapprove', $user) }}')">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-{{ $user->approved ? 'danger' : 'primary' }}">
                              {{ $user->approved ? 'Unapprove' : 'Approve' }}
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Tambahkan script berikut -->
                  <script>
                    function reloadModal(userId, isApproved, approveRoute, unapproveRoute) {
                      // Tentukan action form berdasarkan status approved
                      var actionUrl = isApproved ? unapproveRoute : approveRoute;

                      // Set action form sesuai dengan status approved
                      $('#approveForm' + userId).attr('action', actionUrl);

                      // Reload modal setelah form disubmit
                      $('#approveModal' + userId).on('hidden.bs.modal', function() {
                        $(this).removeData('bs.modal');
                      });
                    }
                  </script>
                  <style>
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
                  </style>
                  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
                  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

                  <td class="text-capitalize">{{$user->nama}}</td>
                  <td>{{ $user->nik }}</td>
                  <td>{{ $user->departemen }}</td>
                  <td>{{ $user->plant }}</td>
                  <td>{{ $user->created_at }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        {{$post -> links()}}
      </div>
    </div>
    <!-- /.container-fluid -->

  </div>
  @else

  <div class="container access-denied">
    <div class="row justify-content-center align-items-center" style="height: 80vh;">
      <div class="col-md-6 text-center">
        <p class="text-danger h2">Tidak ada akses</p>
      </div>
    </div>
  </div>
  <script>
    $(function() {
      $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('
        users.data ') !!}',
        columns: [{
            data: 'id',
            name: 'id'
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'email',
            name: 'email'
          },
          {
            data: 'created_at',
            name: 'created_at'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          },
        ]
      });
    });
  </script>
  <style>
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
      width: 20%;
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
  @endif
  @include('sweetalert::alert')
  <!-- End of Main Content -->
  @endsection