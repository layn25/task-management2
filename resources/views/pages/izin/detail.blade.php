@foreach($data as $item)
<div class="modal fade" id="izinDetailModal-{{ $item->id }}" tabindex="-1" aria-labelledby="izinDetailModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        
            <div class="modal-header">
                <h5 class="modal-title" id="izinDetailModalLabel-{{ $item->id }}">Detail Izin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control" value="{{ $item->user->nama }}" readonly>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="text" class="form-control" 
                            value="{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y H:i') }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="text" class="form-control" 
                            value="{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y H:i') }}" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" rows="3" readonly>{{ $item->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="bukti" class="form-label">Bukti</label><br>
                    @if($item->bukti)
                        <a href="{{ asset('storage/'.$item->bukti) }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i> Lihat Bukti
                        </a>
                    @else
                        <p class="text-muted">Tidak ada bukti</p>
                    @endif
                </div>
            </div>
        
        </div>
    </div>
</div>
@endforeach
