@forelse($agenda as $item)
    @php
        // Logika warna berdasarkan status ENUM di database
        $colorClass = match($item->status) {
            'latihan' => 'green',
            'nasional' => 'blue',
            'internasional' => 'yellow',
            'lainnya' => 'green-faded',
            default => 'green-faded',
        };
    @endphp
    
    <div class="agenda-pill-compact" data-status="{{ $item->status }}">
        <span class="agenda-label-compact label-{{ $colorClass }}">
            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
        </span>
        <h4 class="agenda-text-compact" title="{{ $item->agenda }}">
            {{ $item->agenda }}
        </h4>
    </div>
@empty
    <div class="empty-state" style="text-align: center; padding: 30px; color: #999;">
        <span class="material-symbols-rounded" style="font-size: 40px; opacity: 0.3;">event_busy</span>
        <p style="font-size: 13px; margin-top: 10px;">Tidak ada agenda di bulan ini.</p>
    </div>
@endforelse