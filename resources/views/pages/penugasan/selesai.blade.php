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
            <h5 class="mb-0">Penugasan / Selesai</h5>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Dokumentasi</label>
                <input type="file" name="gambar[]" id="Gambar" class="form-control" multiple required>
                <small class="text-muted">Bisa pilih lebih dari satu gambar</small>
            </div>
            <div id="preview" class="d-flex flex-wrap gap-2"></div>
            <div class="mb-3">
                <label class="form-label">Pengembalian Aset</label>
                @foreach($penugasan->PenugasanAset as $index => $data)
                    <div class="mb-3">
                        <label class="form-label">{{ $index + 1 }}. {{ $data->Aset->nama }}</label>
                        <select name="kondisi[{{ $data->aset->id }}]" class="form-select" required>
                            <option value="baik" {{ (old('kondisi.'.$data->aset->id) ?? $data->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusakBerat" {{ (old('kondisi.'.$data->aset->id) ?? $data->kondisi) == 'rusakRingan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="rusakBerat" {{ (old('kondisi.'.$data->aset->id) ?? $data->kondisi) == 'rusakBerat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

    </div>
    <script>
        document.getElementById('Gambar').addEventListener('change', function(e) {
            let preview = document.getElementById('preview');
            preview.innerHTML = ""; // reset setiap pilih gambar baru

            [...e.target.files].forEach(file => {
                if (!file.type.startsWith("image/")) return;

                let reader = new FileReader();
                reader.onload = function(event) {
                    let img = document.createElement("img");
                    img.src = event.target.result;
                    img.classList.add("img-thumbnail");
                    img.style.maxWidth = "150px";
                    img.style.maxHeight = "150px";
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
        </script>
    @include('pages.penugasan.uploadDokumentasi')
@endsection
