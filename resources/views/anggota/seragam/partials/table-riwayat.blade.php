<table class="modern-table">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Ukuran</th>
            <th class="text-center">Jumlah</th>
            <th>Total Bayar</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($riwayatOrders as $order)
        <tr>
            <td class="td-date">{{ $order->created_at->translatedFormat('d M Y') }}</td>
            <td><span class="size-tag">{{ $order->ukuran }}</span></td>
            <td class="text-center">{{ $order->jumlah }} Pcs</td>
            <td class="td-price">Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
            <td class="text-center">
                <span class="status-pill status-{{ $order->status }}">
                    {{ ucfirst($order->status) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="empty-row">
                <div class="empty-state-table">
                    <span class="material-symbols-rounded">inventory_2</span>
                    <p>Belum ada riwayat pemesanan seragam.</p>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>