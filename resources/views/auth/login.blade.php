<x-guest-layout>
    <!-- Judul Card -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold mb-1" style="font-family: 'Playfair Display', serif; color: #1a1a2e;">Selamat Datang</h1>
        <p class="text-sm" style="color: #7a7a9a;">Masuk ke akun EventVendor Anda</p>
    </div>

    <!-- Session Status handled by SweetAlert2 -->

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label class="auth-label" for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="auth-input" placeholder="nama@email.com" required autofocus autocomplete="username">
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="auth-label" for="password">Password</label>
            <input id="password" type="password" name="password"
                   class="auth-input" placeholder="••••••••" required autocomplete="current-password">
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me + Forgot -->
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                <span class="text-s" style="color: #4a4a6a;">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-btn-secondary text-s">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-btn-primary mt-2">
            Masuk Sekarang
        </button>
    </form>

    <hr class="auth-divider">

    <!-- Register links -->
    <div class="text-center space-y-2">
        <p class="text-s" style="color: #4a4a6a;">
            Belum punya akun?
            <a href="{{ route('register') }}" style="color: #B8860B; font-weight: 600;">Daftar di sini</a>
        </p>
        <p class="text-s" style="color: #7a7a9a;">
            Ingin bergabung sebagai Vendor?
            <a href="{{ route('vendor.register') }}" style="color: #B8860B; font-weight: 500;">Klik di sini</a>
        </p>
    </div>
</x-guest-layout>
