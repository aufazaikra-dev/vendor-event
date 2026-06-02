<x-guest-layout>
    <!-- Icon + Judul -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-yellow-600/30 to-yellow-400/20 border border-yellow-500/30 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" style="color: #C5A028;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold mb-2" style="font-family: 'Playfair Display', serif; color:#1a1a2e;">Verifikasi Email</h1>
        <p class="text-s leading-relaxed" style="color: #7a7a9a;">
            Terima kasih telah mendaftar! Kami telah mengirimkan tautan verifikasi ke email Anda.
            Silakan cek inbox atau folder spam.
        </p>
    </div>

    <!-- Status kirim ulang -->
    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 p-4 rounded-xl text-s flex items-start gap-3" style="color:#16a34a;background:rgba(22,163,74,0.08);border:1px solid rgba(22,163,74,0.2);">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Tautan verifikasi baru telah dikirim ke email Anda.
        </div>
    @endif

    <div class="space-y-3">
        <!-- Kirim ulang -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="auth-btn-primary">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <hr class="auth-divider">

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-3 text-s font-medium rounded-full border transition-all duration-200"
                style="border-color: rgba(184,134,11,0.25); color: #B8860B; background: transparent;"
                onmouseover="this.style.background='rgba(184,134,11,0.08)'; this.style.borderColor='rgba(184,134,11,0.4)';"
                onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(184,134,11,0.25)';">
                Keluar dari Akun
            </button>
        </form>
    </div>
</x-guest-layout>
