@extends('layouts.dashboard')

@section('content')
@push('js')
<script>
    $(document).ready(function () {
        const table = $('#projectTable').DataTable({
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "dom": 'rt<"d-flex justify-content-between align-items-center mt-2"lip>',
            "order": [[0, 'asc']],
        });

        // Custom search
        $('#projectInput').on('keyup', function () {
            table.search(this.value).draw();
        });

        // Owner filter
        $('#ownerFilter').on('change', function () {
            const selectedOwner = $(this).val();

            if (selectedOwner === '') {
                table.column(3).search('').draw();
            } else {
                table.column(3).search('^' + selectedOwner + '$', true, false).draw();
            }
        });
    });
</script>
@endpush

<div class="card-header d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-2">
        <button class="btn btn-light btn-sm" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        <h5 class="mb-0">Projects</h5>
    </div>
    <a href="{{ route('project.create') }}" class="btn btn-primary">+ Buat Project</a>
</div>

<div class="card-body">
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="position-relative">
                <input type="text" class="form-control" id="projectInput" placeholder="Cari project..."
                    style="padding-right: 40px;">
                <button class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" type="button">
                    <i class="bi bi-search text-muted"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6">
            <select class="form-select" id="ownerFilter" aria-label="Owner filter">
                <option value="">Semua Owner</option>
                
            </select>
        </div>
    </div>

    <table id="projectTable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Project</th>
                <th>Tanggal</th>
                <th>Owner</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $p)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $p->name }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($p->start_date)->format('d M Y') }}
                        -
                        {{ \Carbon\Carbon::parse($p->end_date)->format('d M Y') }}
                    </td>
                    <td>{{ $p->Owner->nama }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('project.detail', $p->project_id) }}">
                                        <i class="bi bi-eye me-2"></i>Detail
                                    </a>
                                </li>
                                @if (Auth::user()->id == $p->owner_id)
                                <li>
                                    <form action="{{ route('project.delete', $p->project_id) }}" method="POST" id="delete-{{ $p->project_id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="dropdown-item text-danger" onclick="alertConfirm(this)" data-id="{{ $p->project_id }}">
                                            <i class="bi bi-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
