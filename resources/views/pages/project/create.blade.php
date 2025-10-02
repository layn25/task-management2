@extends('layouts.dashboard')

@section('content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Projects / Tambah Project</h5>
        </div>
        <a href="{{ route('project.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>

    <div class="card-body">
        <form action="{{ route('project.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Project</label>
                <input type="text" class="form-control" name="name" placeholder="Nama Project..." value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="description" rows="4" placeholder="Deskripsi project...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Owner Project</label>
                <select class="form-select" name="owner_id" required>
                    <option value="">Pilih Owner...</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('owner_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->nama }}
                        </option>
                    @endforeach
                </select>
                @error('owner_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-dark">Simpan</button>
            </div>
        </form>
    </div>
@endsection
