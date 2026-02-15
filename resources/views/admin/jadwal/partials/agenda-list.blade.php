@forelse($agendas as $item)
    @php
        $colorClass = match($item->status) {
            'latihan' => 'green',
            'nasional' => 'blue',
            'internasional' => 'yellow',
            'lainnya' => 'green-faded',
            default => 'green-faded',
        };
    @endphp
    
    <div class="agenda-item-box" data-id="{{ $item->id }}">
        <div class="agenda-date-badge border-{{ $colorClass }}">
            <span class="day">{{ $item->tanggal->format('d') }}</span>
            <span class="month">{{ $item->tanggal->translatedFormat('M') }}</span>
        </div>
        <div class="agenda-info">
            <h4 class="agenda-title">{{ $item->agenda }}</h4>
            <div class="agenda-meta-detail">
    <div class="meta-row">
        <span class="material-symbols-rounded">location_on</span>
        <span>{{ $agenda->tempat }}</span>
    </div>
    
    <div class="meta-row">
        <span class="material-symbols-rounded">info</span>
        <span>{{ $agenda->keterangan ?? 'Tidak ada keterangan' }}</span>
    </div>
</div>
@empty
    <div class="empty-state">
        <span class="material-symbols-rounded">event_busy</span>
        <p>Tidak ada agenda untuk bulan ini.</p>
    </div>
@endforelse