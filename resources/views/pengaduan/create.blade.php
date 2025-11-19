<x-app-layout>
    <x-slot name="title">
        Buat Pengaduan Baru
    </x-slot>

    <h2>Buat Pengaduan Baru</h2>
    <div style="display:flex; gap:20px; margin-top:14px; align-items:flex-start; flex-wrap:wrap">
        
        <div style="flex:1; min-width:260px">
            <div class="card" style="padding:18px">
                <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                    @csrf <div class="form-group">
                        <label for="judul">Judul Pengaduan</label>
                        <input id="judul" name="judul" type="text" placeholder="Contoh: Keran rusak di Toilet A" value="{{ old('judul') }}" required />
                        @error('judul') <div class="small" style="color:var(--danger);">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select id="kategori" name="kategori">
                            <option>Fasilitas</option>
                            <option>Keamanan</option>
                            <option>Kebersihan</option>
                            <option>IT</option>
                            </select>
                        @error('kategori') <div class="small" style="color:var(--danger);">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="6" placeholder="Jelaskan kronologi dan lampiran jika ada">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="small" style="color:var(--danger);">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="lampiran">Lampiran Foto (Opsional)</label>
                        <input id="lampiran" name="lampiran" type="file" accept="image/*" />
                        @error('lampiran') <div class="small" style="color:var(--danger);">{{ $message }}</div> @enderror
                    </div>

                    <button class="btn" type="submit">Kirim Pengaduan</button>

                </form>
            </div>
        </div>

        <aside style="width:420px; min-width:520px">
            <div class="card" style="padding: 20px;">
                <h4>Tips Menulis Pengaduan</h4>
                <ul style="margin-top:6px;color:var(--muted);line-height:1.6; padding-left: 20px;">
                    <li>Jelaskan lokasi dan waktu kejadian.</li>
                    <li>Sertakan bukti (foto) jika memungkinkan.</li>
                    <li>Gunakan bahasa sopan & jelas.</li>
                </ul>
            </div>
        </aside>
    </div>
</x-app-layout>