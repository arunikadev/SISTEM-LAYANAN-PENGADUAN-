<x-guest-layout>

    @if (session('status'))
        <div style="font-size: 0.875rem; font-weight: 600; color: var(--success); margin-bottom: 1rem; background-color: #e0f5e9; padding: 0.75rem 1rem; border-radius: 8px;">
            {{ session('status') }}
        </div>
    @endif

    <div class="brand">
        <img src="{{ asset('build/assets/logo.svg') }}" alt="logo"/>
        <h2 id="login-title">Masuk ke Akun Anda</h2>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <div class="small" style="color:var(--danger); margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="small" style="color:var(--danger); margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="role">Masuk sebagai</label>
            <select id="role" name="role" required>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="admin">Admin</option>
            </select>
            @error('role')
                <div class="small" style="color:var(--danger); margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin-top: 1rem;">
            </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin-top: 1rem;">
            <input id="remember_me" type="checkbox" name="remember" style="width: auto;">
            <label for="remember_me" style="margin-bottom: 0;">Ingat saya</label>
        </div>

        <button class="btn" type="submit">Masuk</button>
        
        <div class="small">Belum punya akun? <a href="{{ route('register') }}" style="color:var(--primary); font-weight:700">Daftar</a></div>
        
        @if (Route::has('password.request'))
            <div class="small" style="margin-top:8px;color:var(--muted)">
                <a href="{{ route('password.request') }}" style="color:var(--muted);text-decoration:none">
                    Lupa kata sandi?
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>