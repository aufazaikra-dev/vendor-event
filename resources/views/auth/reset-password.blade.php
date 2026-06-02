<x-guest-layout>
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-yellow-600/30 to-yellow-400/20 border border-yellow-500/30 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" style="color: #C5A028;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold mb-2" style="font-family: 'Playfair Display', serif; color:#1a1a2e;">Buat Password Baru</h1>
        <p class="text-sm" style="color: #7a7a9a;">Silakan masukkan password baru Anda di bawah ini.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
            <label class="auth-label" for="email">Email</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email', $request->email) }}"
                   class="auth-input" placeholder="nama@email.com"
                   required autofocus autocomplete="username">
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Baru -->
        <div>
            <label class="auth-label" for="password">Password Baru</label>
            <input id="password" type="password" name="password"
                   class="auth-input" placeholder="Min. 8 karakter"
                   required autocomplete="new-password">
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label class="auth-label" for="password_confirmation">Konfirmasi Password Baru</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="auth-input" placeholder="Ulangi password baru"
                   required autocomplete="new-password">
            @error('password_confirmation')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-btn-primary">
            Simpan Password Baru
        </button>
    </form>

    <hr class="auth-divider">

    <div class="text-center">
        <a href="{{ route('login') }}" class="auth-btn-secondary text-s">
            ← Kembali ke halaman masuk
        </a>
    </div>
</x-guest-layout>
