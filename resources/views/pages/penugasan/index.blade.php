@extends('layouts.dashboard')

@section('content')
@push('js')
        <script>
            $(document).ready(function () {
                const table = $('#penugasanTable').DataTable({
                    "pageLength": 10,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "dom": 'rt<"d-flex justify-content-between align-items-center mt-2"lip>',
                    "order": [[0, 'asc']],
                });

                // Custom search functionality
                $('#penugasanInput').on('keyup', function () {
                    table.search(this.value).draw();
                });

                // Petugas filter functionality
                $('#petugasFilter').on('change', function () {
                    const selectedPetugas = $(this).val();

                    if (selectedPetugas === '') {
                        table.column(3).search('').draw();
                    } else {
                        table.column(3).search('^' + selectedPetugas + '$', true, false).draw();
                    }
                });
                // Status filter functionality
                $('#statusFilter').on('change', function () {
                    const selectedPetugas = $(this).val();

                    if (selectedPetugas === '') {
                        table.column(4).search('').draw();
                    } else {
                        table.column(4).search('^' + selectedPetugas + '$', true, false).draw();
                    }
                });

                // Clear search when search icon is clicked
                $('.btn-link .bi-search').parent().on('click', function() {
                    $('#penugasanInput').val('');
                    table.search('').draw();
                });
            });
        </script>
    @endpush
    
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Penugasan</h5>
        </div>
        <a href="{{ route('penugasan.create') }}" class="btn btn-primary">+ Buat Penugasan</a>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="position-relative">
                    <input type="text" class="form-control" id="penugasanInput" placeholder="Cari penugasan..."
                        style="padding-right: 40px;">
                    <button class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" type="button">
                        <i class="bi bi-search text-muted"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="petugasFilter" aria-label="Petugas filter">
                    <option value="">Semua Petugas</option>
                    @foreach ($users as $petugas)
                        <option value="{{ $petugas->nama }}">{{ $petugas->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="statusFilter" aria-label="Petugas filter">
                    <option value="">Semua Status</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Diterima">Diterima</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>
        </div>
        <table id="penugasanTable" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nama Penugasan</th>
                <th>Tanggal Tugas</th>
                <th>Nama Petugas</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($penugasan as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->nama_tugas }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y H:i') }} 
                                - 
                            {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y H:i') }}
                        </td>
                        <td>{{ $p->User->nama }}</td>
                        <td>
                            @if($p->status === '0')
                                <span class="badge bg-warning">Diproses</span>
                            @elseif($p->status === 'diterima')
                                <span class="badge bg-primary">Diterima</span>
                            @elseif($p->status === 'ditolak')
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
                                        <a class="dropdown-item" href="{{ route('penugasan.detail', $p->id) }}">
                                            <i class="bi bi-eye me-2"></i>Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('penugasan.update', $p->id) }}">
                                            <i class="bi bi-pencil me-2"></i>Ubah
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="" method="POST" id="delete-{{ $p->id }}">
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
