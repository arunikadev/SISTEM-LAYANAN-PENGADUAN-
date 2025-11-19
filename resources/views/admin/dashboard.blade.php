<x-app-layout>
    <x-slot name="title">
        Dashboard Admin
    </x-slot>

    <section class="header-hero">
        <div>
            <h1 id="welcome-name">Halo, {{ Auth::user()->name }} 👋</h1>
            <p class="text-muted" style="margin-top:6px">Tinjau, kelola, dan tanggapi pengaduan yang masuk.</p>
        </div>
    </section>

    <section style="margin-top:24px">
        @if (session('success'))
            <div style="font-size: 0.875rem; font-weight: 600; color: var(--success); margin-bottom: 1rem; background-color: #e0f5e9; padding: 0.75rem 1rem; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="tabs" style="border-bottom: 1px solid #e0e0e0;">
            <button class="tab-button active" onclick="openTab('aktif')">Pengaduan Aktif</button>
            <button class="tab-button" onclick="openTab('selesai')">Riwayat Selesai</button>
        </div>

        <div id="aktif" class="tab-content">
            <table class="table" aria-label="Tabel pengaduan aktif">
                <thead>
                <tr>
                    <th>ID Tiket</th>
                    <th>Judul</th>
                    <th>Pelapor</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="admin-table-body">
                    @forelse ($pengaduanAktif as $pengaduan)
                        <tr class="main-row">
                            <td>#{{ $pengaduan->id }}</td>
                            <td>{{ $pengaduan->judul }}</td>
                            <td>{{ $pengaduan->user->name }}</td>
                            <td>{{ $pengaduan->created_at->format('d M Y') }}</td>
                            <td>
                                @if ($pengaduan->status == 'pending')
                                    <span class="badge pending">Menunggu</span>
                                @elseif ($pengaduan->status == 'processing')
                                    <span class="badge processing">Diproses</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn secondary" style="margin:0;" onclick="toggleEditRow('{{ $pengaduan->id }}')">
                                    Kelola
                                </button>
                            </td>
                        </tr>

                        <tr class="edit-panel-row" id="edit-panel-{{ $pengaduan->id }}" style="display:none;">
                            <td colspan="6" style="padding: 24px !important; background-color: #f8f9fa;">
                                <form method="POST" action="{{ route('admin.pengaduan.update', $pengaduan->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Tulis Tanggapan Anda:</label>
                                        <textarea name="balasan_admin" rows="4" placeholder="Tulis balasan...">{{ $pengaduan->balasan_admin }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Ubah Status:</label>
                                        <select name="status">
                                            <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="processing" {{ $pengaduan->status == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
                                            <option value="done">Selesai</option>
                                        </select>
                                    </div>
                                    <button class="btn" type="submit">Simpan & Kirim Notifikasi</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 20px;">
                                Tidak ada pengaduan aktif.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="margin-top: 20px;">
            {{ $pengaduanAktif->links() }}
            </div>
        </div> <div id="selesai" class="tab-content" style="display:none;">
            <table class="table" aria-label="Tabel riwayat selesai">
                <thead>
                <tr>
                    <th>ID Tiket</th>
                    <th>Judul</th>
                    <th>Pelapor</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($pengaduanSelesai as $pengaduan)
                        <tr>
                            <td>#{{ $pengaduan->id }}</td>
                            <td>{{ $pengaduan->judul }}</td>
                            <td>{{ $pengaduan->user->name }}</td>
                            <td>{{ $pengaduan->updated_at->format('d M Y') }}</td>
                            <td>
                                <span class="badge done">Selesai</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding: 20px;">
                                Belum ada riwayat laporan yang selesai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="margin-top: 20px;">
            {{ $pengaduanSelesai->links() }}
            </div>
        </div> </section>

    @push('scripts')
    <script>
        let openPanelId = null;

        function toggleEditRow(ticketId) {
            const editRow = document.getElementById(`edit-panel-${ticketId}`);
            if (!editRow) return;

            if (openPanelId === ticketId) {
                editRow.style.display = 'none';
                openPanelId = null;
            } else {
                if (openPanelId) {
                    const oldPanel = document.getElementById(`edit-panel-${openPanelId}`);
                    if (oldPanel) oldPanel.style.display = 'none';
                }
                editRow.style.display = 'table-row';
                openPanelId = ticketId;
            }
        }

        // --- FUNGSI BARU UNTUK TAB ---
        function openTab(tabName) {
            // Sembunyikan semua konten tab
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });

            // Nonaktifkan semua tombol tab
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });

            // Tampilkan tab yang dipilih
            document.getElementById(tabName).style.display = 'block';

            // Aktifkan tombol yang dipilih
            document.querySelector(`.tab-button[onclick="openTab('${tabName}')"]`).classList.add('active');
        }
    </script>
    @endpush

</x-app-layout>