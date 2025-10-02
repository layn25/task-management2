@extends('layouts.dashboard')

@section('content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Penugasan / Detail</h5>
        </div>
        <a href="{{ route('admin.penugasan.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label">Nama Penugasan</label>
                <input type="text" class="form-control" value="Lorem ipsum">
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="text" class="form-control" value="20-01-2025 18:00">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="text" class="form-control" value="20-01-2025 18:00">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Petugas</label>
                <input type="text" class="form-control" value="JohnDoe">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Penugasan</label>
                <textarea class="form-control" rows="3">Lorem ipsum</textarea>
            </div>
        </form>

        <hr class="my-3"/>

        <h6 class="mb-3">Aset yang Dipakai</h6>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Aset</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Aset 1</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Aset 2</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Aset yang Dipakai -->
@endsection
