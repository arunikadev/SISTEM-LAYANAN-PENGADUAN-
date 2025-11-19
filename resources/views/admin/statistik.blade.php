<x-app-layout>
    <x-slot name="title">
        Statistik Pengaduan
    </x-slot>

    <section class="header-hero">
        <div>
            <h1>Analisis & Statistik Pengaduan</h1>
            <p class="text-muted" style="margin-top:6px">Pantau tren dan data pengaduan secara keseluruhan.</p>
        </div>
    </section>

    <section class="cards" aria-label="ringkasan statistik">
        <div class="card-widget">
            <div style="font-size:13px;color:var(--muted)">Total Laporan Masuk</div>
            <div id="stats-total" style="font-size:22px;font-weight:700;margin-top:10px">{{ $stats['total'] }}</div>
        </div>
        <div class="card-widget">
            <div style="font-size:13px;color:var(--muted)">Laporan Pending</div>
            <div id="stats-pending" style="font-size:22px;font-weight:700;margin-top:10px">{{ $stats['pending'] }}</div>
        </div>
        <div class="card-widget">
            <div style="font-size:13px;color:var(--muted)">Laporan Selesai</div>
            <div id="stats-done" style="font-size:22px;font-weight:700;margin-top:10px">{{ $stats['done'] }}</div>
        </div>
    </section>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px; margin-top: 24px;">
        <div class="card" style="padding:24px;">
            <h4>Laporan per Kategori</h4>
            <canvas id="chart-by-category" height="200"></canvas>
        </div>
        <div class="card" style="padding:24px;">
            <h4>Distribusi Status Laporan</h4>
            <div style="max-width: 300px; margin: auto;">
                <canvas id="chart-by-status" height="200"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Pastikan DOM sudah dimuat
        document.addEventListener('DOMContentLoaded', function() {

            // 1. Grafik Kategori (Bar Chart)
            const ctxCategory = document.getElementById('chart-by-category');
            if (ctxCategory) {
                new Chart(ctxCategory, {
                    type: 'bar',
                    data: {
                        // Ambil data JSON dari controller
                        labels: {!! $kategoriLabels !!}, 
                        datasets: [{
                            label: 'Jumlah Pengaduan',
                            // Ambil data JSON dari controller
                            data: {!! $kategoriData !!}, 
                            backgroundColor: 'rgba(69, 104, 130, 0.7)',
                            borderColor: 'rgba(69, 104, 130, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: { scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
                });
            }

            // 2. Grafik Status (Doughnut Chart)
            const ctxStatus = document.getElementById('chart-by-status');
            if (ctxStatus) {
                new Chart(ctxStatus, { 
                    type: 'doughnut', 
                    data: { 
                        // Ambil data JSON dari controller
                        labels: {!! $statusLabels !!}, 
                        datasets: [{ 
                            // Ambil data JSON dari controller
                            data: {!! $statusData !!}, 
                            backgroundColor: ['#f0ad4e', '#f6c85f', '#2e9b4a', '#d9534f'] 
                        }] 
                    } 
                });
            }
        });
    </script>
    @endpush

</x-app-layout>