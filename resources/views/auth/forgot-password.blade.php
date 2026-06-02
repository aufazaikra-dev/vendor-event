<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold mb-1" style="font-family: 'Playfair Display', serif; color:#1a1a2e;">Lupa Password?</h1>
        <p class="text-sm leading-relaxed" style="color: #7a7a9a;">
            Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password.
        </p>
    </div>

    <!-- Session Status -->
    @if(session('status'))
        <div class="mb-5 p-4 rounded-xl text-sm flex items-start gap-3" style="color:#16a34a;background:rgba(22,163,74,0.08);border:1px solid rgba(22,163,74,0.2);">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label class="auth-label" for="email">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="auth-input" placeholder="nama@email.com" required autofocus>
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-btn-primary">
            Kirim Tautan Reset Password
        </button>
    </form>

    <hr class="auth-divider">

    <div class="text-center">
        <a href="{{ route('login') }}" class="auth-btn-secondary text-s">
            ← Kembali ke halaman masuk
        </a>
    </div>
</x-guest-layout>
