<div class="dash-card card-agenda">
    <h3 class="card-title-main">Agenda</h3>

    <div class="agenda-container">
        <div class="agenda-list-side">
            <div class="agenda-scroll-area" id="agenda-list-container">
                {{-- Memanggil partial list --}}
                @include('admin.dashboard.partials.agenda-list', ['agenda' => $agenda])
            </div>
        </div>

        <div class="agenda-calendar-side">
            <div class="calendar-card">
                <div class="cal-header">
                    <button type="button" class="nav-btn" id="btn-prev-month">‹</button>
                    <span class="month-year" id="display-month-year">
                        {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                    </span>
                    <button type="button" class="nav-btn" id="btn-next-month">›</button>
                </div>

                <div class="cal-weekdays">
                    <span>MIN</span><span>SEN</span><span>SEL</span><span>RAB</span><span>KAM</span><span>JUM</span><span>SAB</span>
                </div>

                <div class="cal-grid" id="calendar-grid">
                    {{-- Grid tanggal akan di-render ulang oleh JavaScript --}}
                </div>
            </div>
        </div>
    </div>
</div>