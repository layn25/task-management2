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
                        "searchPlaceholder": "Cari...",
                    },
                    "dom": 'rt<"d-flex justify-content-between align-items-center mt-2"lip>',
                    "order": [[0, 'asc']]
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
            <h5 class="mb-0">Aset</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <!-- Search Input -->
            <div class="position-relative">
                <input type="text" class="form-control" id="searchInput" placeholder="Nama Asets..."
                    style="padding-right: 40px; width: 250px;">
                <button class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" type="button">
                    <i class="bi bi-search text-muted"></i>
                </button>
            </div>
            <!-- Add User Button -->
            <a href="{{ route('aset.create') }}" class="btn btn-primary">+ Tambah Aset</a>
        </div>
    </div>
    <div class="card-body">
        <table id="usersDataTable" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Tanggal terakhir Opname</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>
                            @if($p->OpnameAset->isNotEmpty())
                                {{ \Carbon\Carbon::parse($p->OpnameAset->max('tanggal'))->format('d M Y H:i') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($p->kondisi === 'baik')
                                <span class="badge bg-success">Baik</span>
                            @elseif($p->kondisi === 'rusakRingan')
                                <span class="badge bg-warning">Rusak Ringan</span>
                            @elseif($p->kondisi === 'rusakBerat')
                                <span class="badge bg-danger">Rusak Berat</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item"  href="{{ route('aset.detail', $p->id) }}">
                                            <i class="bi bi-eye me-2"></i>Detail
                                        </a>
                                    </li>
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
