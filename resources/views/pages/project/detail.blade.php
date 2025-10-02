@extends('layouts.dashboard')

@section('content')
    @push('js')
<script>
    $(document).ready(function () {
        const table = $('#taskDataTable').DataTable({
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "dom": 'rt<"d-flex justify-content-between align-items-center mt-2"lip>',
            "order": [[0, 'asc']],
        });

        // Custom search
        $('#taskInput').on('keyup', function () {
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
            <h5 class="mb-0">Project / Detail</h5>
        </div>
        <a href="{{ route('project.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>

    <div class="card-body">
        @if (Auth::user()->id == $data->owner_id)
        <form action="{{ route('project.update', $data->project_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_tugas">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $data->start_date }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $data->end_date }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Owner</label>
                <select name="owner_id" class="form-select" disabled>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $data->owner_id == $user->id ? 'selected' : '' }}>
                            {{ $user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Penugasan</label>
                <textarea name="description" class="form-control" rows="3" required>{{ $data->description }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        <hr class="my-3"/>
        @endif
        {{-- Daftar Tasks --}}
    <h5 class="mb-3">Daftar Tasks</h5>
    @if (Auth::user()->id == $data->owner_id)
    <div class="row mb-3 ">
        <div class="col-md-10">
            <div class="position-relative">
                <input type="text" class="form-control" id="projectInput" placeholder="Cari project..."
                    style="padding-right: 40px;">
                <button class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" type="button">
                    <i class="bi bi-search text-muted"></i>
                </button>
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#taskModal">
                + Tambah Task
            </button>
        </div>
    </div>
    @else
    <div class="row mb-3 ">
        <div class="col-md-12">
            <div class="position-relative">
                <input type="text" class="form-control" id="projectInput" placeholder="Cari project..."
                    style="padding-right: 40px;">
                <button class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" type="button">
                    <i class="bi bi-search text-muted"></i>
                </button>
            </div>
        </div>
    </div>
    @endif
    <table id="taskDataTable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Progress</th>
                <th>Assignee</th>
                <th>Deadline</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->Task as $key => $task)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td>
                        <span class="badge 
                            @if($task->status=='todo') bg-primary
                            @elseif($task->status=='in_progress') bg-warning
                            @elseif($task->status=='review') bg-info
                            @elseif($task->status=='done') bg-success
                            @endif">
                            {{ ucfirst(str_replace('_',' ',$task->status)) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge 
                            @if($task->priority=='low') bg-success
                            @elseif($task->priority=='medium') bg-primary
                            @elseif($task->priority=='high') bg-warning
                            @elseif($task->priority=='urgent') bg-danger
                            @endif">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </td>
                    <td>{{ $task->percentage }}%</td>
                    <td>{{ $task->Assignee->nama ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($task->end_date)->format('d M Y') }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTaskModal-{{ $task->task_id }}">
                                        <i class="bi bi-eye me-2"></i>Detail
                                    </a>
                                </li>
                                {{-- <li><hr class="dropdown-divider"></li> --}}
                                @if (Auth::user()->id == $data->owner_id)
                                <li>
                                    <form action="{{ route('project.deleteTask', $task->task_id) }}" method="POST" id="delete-{{ $task->task_id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="dropdown-item text-danger" onclick="alertConfirm(this)" data-id="{{ $task->task_id }}">
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
    @include('pages.project.task.create')
    @include('pages.project.task.edit')
@endsection
