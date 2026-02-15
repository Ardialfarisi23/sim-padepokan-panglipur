<div class="table-responsive">
    <table class="table table-custom align-middle">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keperluan Pengeluaran</th>
                <th>Metode</th>
                <th>Nominal (Rp.)</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal)->format('d - m - Y') }}</td>
                <td class="fw-bold text-dark">{{ $item->keperluan }}</td>
                <td>
                    <span class="badge-metode variant-pengeluaran">
                        <span class="material-symbols-rounded">credit_card</span>
                        {{ $item->metode }}
                    </span>
                </td>
                <td class="nominal-pengeluaran">
                    {{ number_format($item->nominal, 0, ',', '.') }},
                </td>
                <td>
                    <div class="action-btns">
                        <button class="btn-edit-small" onclick="editTransaksi({{ $item->id }}, 'pengeluaran')">
                            <span class="material-symbols-rounded">edit</span>
                        </button>
                        <button class="btn-delete-small" onclick="hapusTransaksi({{ $item->id }}, 'pengeluaran')">
                            <span class="material-symbols-rounded">delete</span>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-5 text-muted">Belum ada data pengeluaran bulan ini.</td>
            </tr>
            @endforelse
        </tbody>
        @if($data->count() > 0)
        <tfoot>
            <tr class="footer-total variant-pengeluaran">
                <td colspan="3" class="text-center">Total Keseluruhan</td>
                <td colspan="2" class="text-start nominal-pengeluaran">
                    {{ number_format($data->sum('nominal'), 0, ',', '.') }},
                </td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>