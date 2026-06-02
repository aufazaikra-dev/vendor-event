<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold mb-1" style="font-family: 'Playfair Display', serif; color: #1a1a2e;">Buat Akun Baru</h1>
        <p class="text-sm" style="color: #7a7a9a;">Daftar sebagai pelanggan EventVendor</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Nama -->
        <div>
            <label class="auth-label" for="name">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   class="auth-input" placeholder="Nama Anda" required autofocus autocomplete="name">
            @error('name')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="auth-label" for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="auth-input" placeholder="nama@email.com" required autocomplete="username">
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="auth-label" for="password">Password</label>
            <input id="password" type="password" name="password"
                   class="auth-input" placeholder="Min. 8 karakter" required autocomplete="new-password">
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <label class="auth-label" for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="auth-input" placeholder="Ulangi password" required autocomplete="new-password">
            @error('password_confirmation')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-btn-primary pt-1">
            Daftar Sekarang
        </button>
    </form>

    <hr class="auth-divider">

    <div class="text-center">
        <p class="text-s" style="color: #4a4a6a;">
            Sudah punya akun?
            <a href="{{ route('login') }}" style="color: #B8860B; font-weight: 600;">Masuk di sini</a>
        </p>
    </div>
</x-guest-layout>
