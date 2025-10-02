<div class="modal fade" id="izinModal" tabindex="-1" aria-labelledby="izinModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        
        <div class="modal-header">
            <h5 class="modal-title" id="izinModalLabel">Izin / Ajukan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="datetime-local" class="form-control" name="tanggal_mulai" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="datetime-local" class="form-control" name="tanggal_selesai" required>
                    </div>
                </div>

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