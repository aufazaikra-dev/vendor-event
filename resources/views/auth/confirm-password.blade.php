<x-guest-layout>
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-yellow-600/30 to-yellow-400/20 border border-yellow-500/30 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" style="color: #C5A028;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold mb-2" style="font-family: 'Playfair Display', serif; color:#1a1a2e;">Konfirmasi Password</h1>
        <p class="text-sm leading-relaxed" style="color: #7a7a9a;">
            Area ini aman dan terlindungi. Harap konfirmasi password Anda sebelum melanjutkan.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label class="auth-label" for="password">Password</label>
            <input id="password" type="password" name="password"
                   class="auth-input" placeholder="Masukkan password Anda" required autocomplete="current-password">
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-btn-primary">
            Konfirmasi & Lanjutkan
        </button>
    </form>
</x-guest-layout>
