@extends('layouts.dashboard')

@section('content')
    <script>
        $(document).ready(function () {
            $('#opnameDataTable').DataTable();
        });
    </script>
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-light btn-sm" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0">Penugasan / Detail</h5>
        </div>
        <a href="{{ route('aset.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>

    <div class="card-body">
        
        <div class="mb-3">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" value="{{ $aset->nama }}" disabled>
        </div>
        <div class="mb-3">
            <label for="kondisi">Kondisi Saat Ini</label>
            <input type="text" class="form-control" 
                value="{{ $aset->kondisi === 'baik' ? 'Baik' : ($aset->kondisi === 'rusakRingan' ? 'Rusak Ringan' : 'Rusak Berat') }}" 
                disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Aset</label>
            <textarea class="form-control" rows="3" disabled>{{ $aset->deskripsi }}</textarea>
        </div>

        <hr class="my-3"/>

        <div class="mb-3">
            <label class="form-label">Riwayat Kondisi Aset</label>
        </div>

        <table id="opnameDataTable" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Detail Kondisi</th>
                <th>Kondisi</th>
                <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($aset->OpnameAset as $key => $p)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $p->deskripsi }}</td>
                        <td>
                            @if($p->kondisi === 'baik')
                                <span class="badge bg-success">Baik</span>
                            @elseif($p->kondisi === 'rusakRingan')
                                <span class="badge bg-warning">Rusak Ringan</span>
                            @elseif($p->kondisi === 'rusakBerat')
                                <span class="badge bg-danger">Rusak Berat</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        
        
    </div>
@endsection
