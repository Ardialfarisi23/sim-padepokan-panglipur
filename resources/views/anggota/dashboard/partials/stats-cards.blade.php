<div class="stats-grid">
    <div class="stat-item main-belt">
        <div class="stat-icon">
            <span class="material-symbols-rounded">Military_tech</span>
        </div>
        <div class="stat-content">
            <p class="stat-label">Tingkat Sabuk</p>
            <h4 class="stat-value text-capitalize">{{ $stats['sabuk'] }}</h4>
        </div>
        <div class="belt-indicator belt-{{ strtolower($stats['sabuk']) }}"></div>
    </div>

    <div class="stat-item">
        <div class="stat-icon icon-blue">
            <span class="material-symbols-rounded">History_edu</span>
        </div>
        <div class="stat-content">
            <p class="stat-label">Ujian Diikuti</p>
            <h4 class="stat-value">{{ $stats['total_ujian'] }} Kali</h4>
        </div>
    </div>

    <div class="stat-item">
        <div class="stat-icon {{ optional($stats['ujian_terakhir'])->status == 'lulus' ? 'icon-green' : 'icon-red' }}">
            <span class="material-symbols-rounded">
                {{ optional($stats['ujian_terakhir'])->status == 'lulus' ? 'Verified' : 'Pending_actions' }}
            </span>
        </div>
        <div class="stat-content">
            <p class="stat-label">Hasil Ujian Terakhir</p>
            <h4 class="stat-value">
                {{ optional($stats['ujian_terakhir'])->status == 'lulus' ? 'Lulus' : (optional($stats['ujian_terakhir'])->status == 'tidak' ? 'Mengulang' : '-') }}
            </h4>
        </div>
    </div>
</div>