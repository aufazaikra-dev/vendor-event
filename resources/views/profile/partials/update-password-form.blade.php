<section>
    <header class="mb-6">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 rounded-full flex items-center justify-center" style="background:rgba(184,134,11,0.1);border:1px solid rgba(184,134,11,0.2);">
                <svg class="w-5 h-5" style="color:#B8860B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="section-title">Ubah Password</h2>
        </div>
        <p class="section-desc">Gunakan password yang panjang dan unik agar akun Anda tetap aman.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label class="p-label" for="update_password_current_password">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password"
                   class="p-input" placeholder="••••••••" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <p class="p-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="p-label" for="update_password_password">Password Baru</label>
            <input id="update_password_password" name="password" type="password"
                   class="p-input" placeholder="Min. 8 karakter" autocomplete="new-password">
            @error('password', 'updatePassword')
                <p class="p-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="p-label" for="update_password_password_confirmation">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                   class="p-input" placeholder="Ulangi password baru" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <p class="p-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="p-btn">Simpan Password</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm" style="color:#16a34a;">
                    ✓ Password diperbarui!
                </p>
            @endif
        </div>
    </form>
</section>
