@forelse($agendas as $item)
    @php
        $statusLower = strtolower($item->status ?? 'latihan');
        $colorClass = match($statusLower) {
            'latihan' => 'green',
            'nasional' => 'blue',
            'internasional' => 'yellow',
            default => 'slate',
        };

        // Pastikan tanggal bisa diparsing
        $tgl = \Carbon\Carbon::parse($item->tanggal);
    @endphp
    
    <div class="agenda-item-box border-{{ $colorClass }}" 
     onclick="openAgendaModal('{{ $item->agenda }}', '{{ $tgl->translatedFormat('d F Y') }}', '{{ $item->lokasi }}', '{{ $item->keterangan }}', '{{ $item->status }}', '{{ $colorClass }}')"
     style="cursor: pointer;">
        <div class="agenda-date-badge">
            <span class="day">{{ $tgl->format('d') }}</span>
            <span class="month">{{ $tgl->translatedFormat('M') }}</span>
        </div>

        <div class="agenda-info">
            <h4 class="agenda-title">{{ $item->agenda }}</h4>
            <div class="agenda-meta-detail">
                <div class="meta-row">
                    <span class="material-symbols-rounded">location_on</span>
                    <span class="text-content">{{ $item->lokasi ?? 'Lokasi tidak diatur' }}</span>
                </div>
                
                <div class="meta-row">
                    <span class="material-symbols-rounded">info</span>
                    <span class="text-content">{{ $item->keterangan ?? 'Tidak ada keterangan' }}</span>
                </div>
            </div>
        </div>

        <div class="agenda-status-right">
            <span class="status-tag tag-{{ $colorClass }}">
                {{ $item->status }}
            </span>
        </div>
    </div>
@empty
    <div class="empty-state" style="text-align: center; padding: 30px; color: #64748b;">
        <span class="material-symbols-rounded" style="font-size: 48px;">event_busy</span>
        <p>Tidak ada agenda untuk bulan ini.</p>
    </div>
@endforelse