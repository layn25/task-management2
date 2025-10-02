@extends('layouts.dashboard')

@section('content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">User / Detail</h5>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('users.edit', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Nama..." value="{{ old('nama') ?? $data->nama }}" required>
                @error('nama')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email..." value="{{ old('email') ?? $data->email  }}" required>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="position-relative">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password...">
                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" id="togglePassword">
                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
                <small class="text-danger">Kosongkan jika tidak ingin mengganti password</small>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="number" class="form-control" name="telepon" placeholder="Telepon..." value="{{ old('telepon') ?? $data->telepon }}">
                @error('telepon')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Role</label>
                <select class="form-select" name="roles" required>
                    <option value="">Pilih Role...</option>
                    <option value="admin" 
                        {{ (old('roles') ?? $data->roles) == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                    <option value="pegawai" 
                        {{ (old('roles') ?? $data->roles) == 'pegawai' ? 'selected' : '' }}>
                        Pegawai
                    </option>
                </select>
                @error('roles')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-dark">Simpan</button>
            </div>
        </form>

    </div>

    <!-- Aset yang Dipakai -->

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordField.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        });
    </script>
@endsection
