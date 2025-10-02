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
            <h5 class="mb-0">Izin</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#izinModal">+ Ajukan Izin</button>
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
                    <option value="Diproses">Diproses</option>
                    <option value="Ditolak">Ditolak</option>
                    <option value="Diterima">Diterima</option>
                </select>
            </div>
        </div>
        <table id="usersDataTable" class="table table-striped table-hover">
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal Izin</th>
                        <th>Akhir Izin</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $izin)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $izin->user->nama ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($izin->tanggal_mulai)->format('d M Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($izin->tanggal_selesai)->format('d M Y H:i') }}</td>
                        <td>
                            @if($izin->status === 'diproses')
                                <span class="badge bg-warning">Diproses</span>
                            @elseIf($izin->status === 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#izinDetailModal-{{ $izin->id }}">
                                            <i class="bi bi-eye me-2"></i> Detail
                                        </a>
                                    </li>
                                    @if (Auth::user()->roles == 'admin')
                                        @if ($izin->status === 'diproses')
                                        <li>
                                            <form action="{{ route('izin.diterima', $izin->id) }}" method="POST" id="terima-{{ $izin->id }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="dropdown-item text-success" onclick="confirmTerima(this)" data-id="{{ $izin->id }}">
                                                    <i class="bi bi-check-circle me-2"></i> Diterima
                                                </button>
                                            </form>
                                        </li>

                                        <li>
                                            <form action="{{ route('izin.ditolak', $izin->id) }}" method="POST" id="tolak-{{ $izin->id }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="dropdown-item text-danger" onclick="confirmTolak(this)" data-id="{{ $izin->id }}">
                                                    <i class="bi bi-x-circle me-2"></i> Ditolak
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('izin.delete', $izin->id) }}" method="POST" id="delete-{{ $izin->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item text-danger" onclick="alertConfirm(this)" data-id="{{ $izin->id }}">
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
    @include('pages.izin.create')
    @include('pages.izin.detail')
@endsection
