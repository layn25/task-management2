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
            <h5 class="mb-0">Users</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <!-- Add User Button -->
            <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="position-relative">
                    <input type="text" class="form-control" id="searchInput" placeholder="Nama User..."
                        style="padding-right: 40px;">
                    <button class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" type="button">
                        <i class="bi bi-search text-muted"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="rolesFilter" aria-label="Roles filter">
                    <option value="">Semua</option>
                    <option value="Admin">Admin</option>
                    <option value="Pegawai">Pegawai</option>
                </select>
            </div>
        </div>
        <table id="usersDataTable" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->telepon ?? 'Tidak ada' }}</td>
                        <td>
                            @if($p->roles === 'pegawai')
                                <span class="badge bg-success">Pegawai</span>
                            @elseif($p->roles === 'admin')
                                <span class="badge bg-primary">Admin</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    {{-- <li>
                                        <a class="dropdown-item" href="">
                                            <i class="bi bi-eye me-2"></i>Detail
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('users.update', $p->id) }}">
                                            <i class="bi bi-pencil me-2"></i>Ubah
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('users.delete', $p->id) }}" method="POST" id="delete-{{ $p->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item text-danger" onclick="alertConfirm(this)" data-id="{{ $p->id }}">
                                                <i class="bi bi-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
