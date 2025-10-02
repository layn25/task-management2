@extends('layouts.dashboard')

@section('content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Users / Tambah Aset</h5>
        </div>
        <a href="{{ route('aset.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('aset.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" placeholder="Masukan Deskripsi" class="form-control" rows="3" value="{{ old('deskripsi') }}"></textarea>
                @error('deskripsi')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            <h5 class="mb-4">Kondisi Aset</h5>
            <div class="mb-4">
                <label class="form-label">Kondisi</label>
                <select class="form-select" name="kondisi" required>
                    <option value="">Pilih Kondisi...</option>
                    <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusakRingan" {{ old('kondisi') == 'rusakRingan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusakBerat" {{ old('kondisi') == 'rusakBerat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
                @error('roles')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Kondisi</label>
                <textarea name="deskripsi_kondisi" placeholder="Masukan Deskripsi Kondisi"  class="form-control" rows="3" value="{{ old('deskripsi_kondisi') }}"></textarea>
                @error('deskripsi_kondisi')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

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
