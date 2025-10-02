<div class="modal fade" id="uploadDokumentasiModal" tabindex="-1" aria-labelledby="uploadDokumentasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        
        <div class="modal-header">
            <h5 class="modal-title" id="uploadDokumentasiModalLabel">Upload Dokumentasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar[]" id="gambar" class="form-control" multiple required>
                    <small class="text-muted">Bisa pilih lebih dari satu gambar</small>
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