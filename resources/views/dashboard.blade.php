<x-app-layout>
    <section class="header-hero" style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
      <div>
        <h1 id="welcome-name">Halo, {{ Auth::user()->name }} 👋</h1>
        <p class="text-muted" style="margin-top:6px">Lihat status pengaduanmu dan buat pengaduan baru dengan cepat.</p>
      </div>
      <div>
        <a href="{{ route('pengaduan.create') }}" class="btn" style="margin-top:0;">+ Buat Pengaduan Baru</a>
      </div>
    </section>
    
    <section class="cards" aria-label="ringkasan statistik">
      <div class="card-widget">
        <div style="font-size:13px;color:var(--muted)">Total Pengaduan</div>
        <div id="total-card" style="font-size:22px;font-weight:700;margin-top:10px">{{ $total }}</div>
      </div>
      <div class="card-widget">
        <div style="font-size:13px;color:var(--muted)">Sedang Diproses</div>
        <div id="proses-card" style="font-size:22px;font-weight:700;margin-top:10px">{{ $proses }}</div>
      </div>
      <div class="card-widget">
        <div style="font-size:13px;color:var(--muted)">Telah Selesai</div>
        <div id="selesai-card" style="font-size:22px;font-weight:700;margin-top:10px">{{ $selesai }}</div>
      </div>
    </section>
    
    <section style="margin-top:24px">
      <h3>Riwayat Pengaduan Saya</h3>
      <table class="table" aria-label="Tabel riwayat pengaduan">
        <thead>
          <tr>
            <th>ID Tiket</th>
            <th>Judul Pengaduan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pengaduans as $pengaduan)
            <tr>
              <td>{{ $pengaduan->id }}</td>
              <td>{{ $pengaduan->judul }}</td>
              <td>{{ $pengaduan->created_at->format('d M Y') }}</td>
              <td>
                @if ($pengaduan->status == 'pending')
                  <span class="badge pending">Menunggu</span>
                @elseif ($pengaduan->status == 'processing')
                  <span class="badge processing">Diproses</span>
                @elseif ($pengaduan->status == 'done')
                  <span class="badge done">Selesai</span>
                @else
                  <span class="badge danger">{{ $pengaduan->status }}</span>
                @endif
              </td>
              <td>
                <div style="display: flex; gap: 8px;">
                  <a href="{{ route('pengaduan.show', $pengaduan->id) }}" class="btn secondary" style="margin:0; padding: 6px 12px;">Detail</a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" style="text-align:center; padding: 20px;">Belum ada pengaduan.</td>
            </tr>
          @endforelse
          
        </tbody>
      </table>
      <div style="margin-top: 20px;">
          {{ $pengaduans->links() }}
      </div>
    </section>

</x-app-layout>