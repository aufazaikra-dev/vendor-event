<section>
    <header class="mb-6">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 rounded-full flex items-center justify-center" style="background:rgba(184,134,11,0.1);border:1px solid rgba(184,134,11,0.2);">
                <svg class="w-5 h-5" style="color:#B8860B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h2 class="section-title">Informasi Profil</h2>
        </div>
        <p class="section-desc">Perbarui nama dan alamat email akun Anda.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label class="p-label" for="name">Nama Lengkap</label>
            <input id="name" name="name" type="text" class="p-input"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   placeholder="Nama Anda">
            @error('name')
                <p class="p-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="p-label" for="email">Email</label>
            <input id="email" name="email" type="email" class="p-input"
                   value="{{ old('email', $user->email) }}" required autocomplete="username"
                   placeholder="nama@email.com">
            @error('email')
                <p class="p-error">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 rounded-xl" style="background:rgba(184,134,11,0.07);border:1px solid rgba(184,134,11,0.18);">
                    <p class="text-sm" style="color:#4a4a6a;">
                        Email Anda belum terverifikasi.
                        <button form="send-verification" class="font-semibold underline ml-1" style="color:#B8860B;">
                            Kirim ulang verifikasi
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm" style="color:#16a34a;">Tautan verifikasi baru telah dikirim.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="p-btn">Simpan Perubahan</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm" style="color:#16a34a;">
                    ✓ Tersimpan!
                </p>
            @endif
        </div>
    </form>
</section>
