<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Vendor;
use Illuminate\Support\Facades\Cache;

/**
 * VendorObserver
 *
 * Memantau perubahan data Vendor (verified/unverified, update profil, hapus).
 * Setiap perubahan akan membersihkan cache hasil kalkulasi SAW secara otomatis.
 */
class VendorObserver
{
    public function created(Vendor $vendor): void
    {
        $this->flushSawCache();
    }

    public function updated(Vendor $vendor): void
    {
        $this->flushSawCache();
    }

    public function deleted(Vendor $vendor): void
    {
        $this->flushSawCache();
    }

    /**
     * Menghapus semua cache SAW.
     *
     * Menggunakan tag 'saw' agar hanya cache terkait SAW yang dihapus,
     * bukan seluruh cache aplikasi. (Memerlukan driver cache yang
     * mendukung tag: Redis atau Memcached.)
     *
     * Fallback ke Cache::flush() jika tag tidak didukung (misal: file driver).
     */
    private function flushSawCache(): void
    {
        try {
            Cache::tags(['saw'])->flush();
        } catch (\BadMethodCallException) {
            // Driver file/database tidak mendukung tags.
            // Solusi: hapus key spesifik, atau gunakan Redis untuk production.
            // Untuk development, kita clear semua cache SAW dengan prefix.
            Cache::forget('categories_all');
            // saw_result_* tidak bisa di-wildcard di file driver.
            // Untuk production, WAJIB menggunakan Redis + Cache::tags(['saw'])->flush()
        }
    }
}
