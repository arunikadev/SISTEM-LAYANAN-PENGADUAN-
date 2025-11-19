<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="small" style="color:var(--danger); margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nim">NIM</label>
            <input id="nim" type="text" name="nim" value="{{ old('nim') }}" required autocomplete="nim" placeholder="Contoh: H0712XXXXX" />
            @error('nim')
                <div class="small" style="color:var(--danger); margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
                <label for="email">Email Kampus</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@unhas.ac.id" />
                @error('email')
                    <div class="small" style="color:var(--danger); margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="no_wa">Nomor WhatsApp</label>
                <input id="no_wa" type="text" name="no_wa" value="{{ old('no_wa') }}" required autocomplete="tel" placeholder="Contoh: 08123456789">
                @error('no_wa')
                    <div class="small" style="color:var(--danger); margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
           <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Buat kata sandi" />
                @error('password')
                    <div class="small" style="color:var(--danger); margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
                @error('password_confirmation')
                    <div class="small" style="color:var(--danger); margin-t op: 4px;">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn" type="submit">Daftar</button>
        </form>
</x-guest-layout>