<div class="card-seragam-wrapper dash-card">
    <div class="card-header-flex">
        <h3 class="card-title-main"> Seragam</h3>
    </div>

    <div class="seragam-list-container">
        @forelse($seragamSaya as $order)
            <div class="seragam-row-item">
                <div class="seragam-icon-box">
                    <span class="material-symbols-rounded">apparel</span>
                </div>
                
                <div class="seragam-info">
                    <span class="name-text">Seragam Laskar Panglipur</span>
                    <div class="meta-info">
                        <span class="meta-item">Ukuran: <strong>{{ $order->ukuran }}</strong></span>
                        <span class="meta-divider"></span>
                        <span class="meta-item">Jumlah: <strong>{{ $order->jumlah }}</strong></span>
                    </div>
                </div>

                <div class="seragam-status">
                    <span class="status-pill status-{{ str_replace(' ', '-', $order->status) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        @empty
            <div class="empty-state-simple">
                <span class="material-symbols-rounded">shopping_basket</span>
                <p>Belum ada riwayat pesanan seragam.</p>
            </div>
        @endforelse
    </div>
</div>