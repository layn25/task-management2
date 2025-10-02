@extends('layouts.dashboard')

@section('content')
    @push('js')
        <script>
            $(document).ready(function() {
                $('#pilihAset').select2({
                    width: '100%',
                    placeholder: 'Pilih Aset...',
                    allowClear: true,
                });
            })
        </script>
    @endpush

    @push('css')
        <style>
            .select2-container--default .select2-selection--multiple {
                border-radius: 8px;
                border: 1px solid #d1d5db;
                color: #000;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #2563eb;
                color: #ffffff;
                border: none;
                font-size: 0.9rem;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                color: #ffffff;
                border: none;
            }

            .select2-container--default .select2-selection--multiple:focus,
            .select2-container--default.select2-container--focus .select2-selection--multiple {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
                outline: 0;
            }
        </style>
    @endpush

    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Penugasan / Update</h5>
        </div>
        <a href="{{ route('penugasan.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>

    <div class="card-body">
        <form action="" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Petugas</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value=""> Pilih Petugas</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" 
                            {{ old('user_id', $penugasan->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="datetime-local" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($penugasan->tanggal_mulai)->format('Y-m-d\TH:i')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="datetime-local" class="form-control" name="tanggal_selesai" value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($penugasan->tanggal_selesai)->format('Y-m-d\TH:i')) }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="nama_tugas">Nama Tugas</label>
                <input type="text" name="nama_tugas" id="nama_tugas" 
                    class="form-control" required
                    value="{{ old('nama_tugas', $penugasan->nama_tugas) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Penugasan</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $penugasan->deskripsi) }}</textarea>
            </div>

            <hr class="my-3"/>
            <div class="mb-3">
                <label class="form-label">Pilih Aset</label>
                <select class="form-select" id="pilihAset" name="aset[]" multiple="multiple">
                    @foreach ($asets as $aset)
                        <option value="{{ $aset->id }}" 
                            {{ $penugasan->PenugasanAset->pluck('aset_id')->contains($aset->id) ? 'selected' : '' }}>
                            {{ $aset->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
