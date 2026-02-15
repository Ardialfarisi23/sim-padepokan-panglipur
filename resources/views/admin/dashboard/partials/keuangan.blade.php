<div class="dash-card card-keuangan-wrapper">
    <div class="card-header-simple">
        <h3 class="card-title-main">Statistik Keuangan</h3>
        <span class="current-date-badge">{{ now()->translatedFormat('d F Y') }}</span>
    </div>

    <div class="keuangan-grid">
        <div class="keuangan-card item-kas">
            <div class="card-inner">
                <div class="card-header-finance">
                    <div class="icon-box bg-kas">
                        <span class="material-symbols-rounded">account_balance_wallet</span>
                    </div>
                    <span class="finance-title">Total Kas</span>
                </div>
                <h2 class="finance-value">Rp {{ number_format($kas, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="keuangan-card item-pemasukan">
            <div class="card-inner">
                <div class="card-header-finance">
                    <div class="icon-box bg-pemasukan">
                        <span class="material-symbols-rounded">money_bag</span>
                    </div>
                    <span class="finance-title">Pemasukan</span>
                </div>
                <h2 class="finance-value text-green">+Rp {{ number_format($pemasukan, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="keuangan-card item-pengeluaran">
            <div class="card-inner">
                <div class="card-header-finance">
                    <div class="icon-box bg-pengeluaran">
                        <span class="material-symbols-rounded">payments</span>
                    </div>
                    <span class="finance-title">Pengeluaran</span>
                </div>
                <h2 class="finance-value text-red">-Rp {{ number_format($pengeluaran, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
</div>