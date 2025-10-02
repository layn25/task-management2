@foreach($penugasan as $item)
    <div class="modal fade" id="ditolakModal-{{ $item->id }}" tabindex="-1" aria-labelledby="ditolakModalLabel-{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="ditolakModalLabel-{{ $item->id }}">Pengajuan Perubahan Petugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('penugasan.ditolak') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="penugasan_id" id="penugasan_id" value="{{ $item->id }}">
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="bukti" class="form-label">Bukti</label>
                        <input type="file" name="bukti" id="bukti" class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
            
            </div>
        </div>
    </div>
@endforeach