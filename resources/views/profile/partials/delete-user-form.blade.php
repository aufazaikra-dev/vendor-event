<section class="space-y-5">
    <header>
        <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 rounded-full flex items-center justify-center" style="background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.3);">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h2 class="section-title" style="color:#dc2626;">Hapus Akun</h2>
        </div>
        <p class="section-desc">
            Setelah akun dihapus, seluruh data akan dihapus secara permanen. Pastikan Anda sudah menyimpan data penting sebelum melanjutkan.
        </p>
    </header>

    <button type="button"
            class="p-btn-danger"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6"
              style="background:#ffffff; border-radius:16px;">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold mb-2" style="font-family:'Playfair Display',serif; color:#1a1a2e;">
                Hapus Akun Secara Permanen?
            </h2>
            <p class="text-sm mb-6" style="color:#4a4a6a;">
                Tindakan ini tidak dapat dibatalkan. Seluruh data Anda akan dihapus selamanya. Masukkan password untuk konfirmasi.
            </p>

            <div class="mb-5">
                <label class="p-label sr-only" for="password">Password</label>
                <input id="password" name="password" type="password"
                       class="p-input" placeholder="Masukkan password Anda">
                @error('password', 'userDeletion')
                    <p class="p-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" class="p-btn-secondary"
                        x-on:click="$dispatch('close')">
                    Batal
                </button>
                <button type="submit" class="p-btn-danger">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
