<x-app-layout>
    <x-slot name="title">
        Detail Pengaduan #{{ $pengaduan->id }}
    </x-slot>

    <main class="container" style="margin-top:18px">
        <a href="{{ route('dashboard') }}" style="color:var(--primary); font-weight:600;">&larr; Kembali ke Dashboard</a>

        <div class="card" style="margin-top:14px; padding:24px;">
            <div id="detail-content">

                <h2 id="detail-judul">{{ $pengaduan->judul }}</h2>

                <p class="text-muted" style="margin-top:6px;">
                    ID Tiket: <strong id="detail-id">#{{ $pengaduan->id }}</strong> &nbsp;•&nbsp; 
                    Dilaporkan: <span id="detail-tanggal">{{ $pengaduan->created_at->format('d M Y, H:i') }}</span> &nbsp;•&nbsp; 
                    Status: 
                    @if ($pengaduan->status == 'pending')
                        <span id="detail-status" class="badge pending">Menunggu</span>
                    @elseif ($pengaduan->status == 'processing')
                        <span id="detail-status" class="badge processing">Diproses</span>
                    @elseif ($pengaduan->status == 'done')
                        <span id="detail-status" class="badge done">Selesai</span>
                    @else
                        <span id="detail-status" class="badge danger">{{ $pengaduan->status }}</span>
                    @endif
                </p>

                <h4 style="margin-top:24px; border-top:1px solid #f0f0f0; padding-top:18px;">Deskripsi Laporan</h4>
                <p id="detail-deskripsi" class="text-muted" style="line-height:1.7; white-space: pre-wrap;">{{ $pengaduan->deskripsi }}</p>

                @if ($pengaduan->lampiran)
                    <div id="detail-lampiran-wrapper">
                        <h4 style="margin-top:24px;">Lampiran Foto</h4>
                        <img id="detail-lampiran" src="{{ asset('storage/' . $pengaduan->lampiran) }}" alt="Foto Lampiran" style="max-width:100%; max-height:400px; border-radius:10px; margin-top:10px; border:1px solid #eee;">
                    </div>
                @endif

                @if ($pengaduan->balasan_admin)
                    <div id="detail-balasan-wrapper">
                        <h4 style="margin-top:24px;">Balasan Admin</h4>
                        <div style="background:#f9fafb; padding:16px; border-radius:10px; border:1px solid #f2f2f2; white-space: pre-wrap;">
                            <p id="detail-balasan" style="color:var(--muted)">{{ $pengaduan->balasan_admin }}</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </main>
</x-app-layout>