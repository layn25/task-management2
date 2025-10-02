@extends('layouts.dashboard')

@section('content')
    @push('js')
        <script>
            $(document).ready(function () {
                // Initialize DataTable
                const table = $('#usersDataTable').DataTable({
                    "pageLength": 10,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "language": {
                        "search": "",
                        "searchPlaceholder": "Cari users...",
                    },
                    "dom": 'rt<"d-flex justify-content-between align-items-center mt-2"lip>',
                    "order": [[0, 'asc']]
                });
                // Petugas filter functionality
                $('#rolesFilter').on('change', function () {
                    const selectedPetugas = $(this).val();

                    if (selectedPetugas === '') {
                        table.column(4).search('').draw();
                    } else {
                        table.column(4).search('^' + selectedPetugas + '$', true, false).draw();
                    }
                });

                // Custom search functionality
                $('#searchInput').on('keyup', function () {
                    table.search(this.value).draw();
                });
            });
        </script>
    @endpush
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Approval Petugas</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="position-relative">
                    <input type="text" class="form-control" id="searchInput" placeholder="Nama User..."
                        style="padding-right: 40px;">
                    <button class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" type="button">
                        <i class="bi bi-search text-muted"></i>
                    </button>
                </div>
            </div>
        </div>
        <table id="usersDataTable" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Petugas</th>
                <th>Nama Penugasan</th>
                <th>Lihat Detail</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->Penugasan->nama_tugas }}</td>
                        <td>{{ $p->Penugasan->User->nama }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approvalDetailModal-{{ $p->id }}">Lihat</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('pages.approval_tugas.detail')
@endsection
