@extends('layouts.dashboard')

@section('content')
    <script>
        $(document).ready(function () {
            $('#asetDataTable').DataTable();
        });
    </script>
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Penugasan / Detail</h5>
        </div>
        <a href="{{ route('penugasan.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>

    <div class="card-body">
        
        <div class="mb-3">
            <label for="nama_tugas">Nama Tugas</label>
            <input type="text" class="form-control" value="{{ old('nama_tugas', $penugasan->nama_tugas) }}" disabled>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tanggal Mulai</label>
                <input type="text" class="form-control" value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($penugasan->tanggal_mulai)->format('d M Y H:i')) }}"  disabled>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Selesai</label>
                <input type="text" class="form-control" value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($penugasan->tanggal_selesai)->format('d M Y H:i')) }}"  disabled>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Petugas</label>
            <input type="text"class="form-control" value="{{ old('nama_tugas', $penugasan->user->nama) }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Penugasan</label>
            <textarea class="form-control" rows="3" disabled>{{ old('deskripsi', $penugasan->deskripsi) }}</textarea>
        </div>

        <hr class="my-3"/>

        <table id="" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Tanggal Pinjam</th>
                <th>Kondisi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($penugasan->PenugasanAset as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->Aset->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y H:i') }}</td>
                        <td>
                            @if($p->Aset->kondisi === 'baik')
                                <span class="badge bg-success">Baik</span>
                            @elseif($p->Aset->kondisi === 'rusakRingan')
                                <span class="badge bg-warning">Rusak Ringan</span>
                            @elseif($p->Aset->kondisi === 'rusakBerat')
                                <span class="badge bg-danger">Rusak Berat</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        
        <div class="d-flex justify-content-between mt-2">
            <a href="{{ route('penugasan.selesai', $penugasan->id) }}" class="btn btn-success">Selesai</a>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger mr-1">Hapus Penugasan</button>
                <a href="{{ route('penugasan.update', $penugasan->id) }}" class="btn btn-primary">Ubah Penugasan</a>
            </div>
        </div>
        
    </div>
@endsection
