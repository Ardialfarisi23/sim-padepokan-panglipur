<div class="modal fade" id="modalRestock" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <div class="modal-title-wrapper">
                    <span class="material-symbols-rounded title-icon">inventory</span>
                    <h5 class="modal-title">Restock Gudang</h5>
                </div>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            
            <form action="{{ route('admin.seragam.updateStock') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="modal-subtitle">Pilih ukuran seragam dan masukkan jumlah stok yang baru saja masuk ke gudang.</p>
                    
                    <div class="form-group-custom">
                        <label class="input-label">Pilih Ukuran</label>
                        <div class="size-grid">
                            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                <input type="radio" class="btn-check" name="ukuran" id="size-{{ $size }}" value="{{ $size }}" required>
                                <label class="size-item" for="size-{{ $size }}">{{ $size }}</label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label for="jumlah" class="input-label">Jumlah (Pcs)</label>
                        <div class="input-with-icon">
                            <span class="material-symbols-rounded">shopping_cart</span>
                            <input type="number" name="jumlah" id="jumlah" placeholder="Contoh: 20" min="1" required>
                        </div>
                    </div>

                    <div class="modal-info-box">
                        <span class="material-symbols-rounded">info</span>
                        <p>Penambahan stok ini akan tercatat otomatis di <strong>Riwayat Log Stok</strong>.</p>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modal-save">
                        <span>Simpan Stok</span>
                        <span class="material-symbols-rounded">save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>