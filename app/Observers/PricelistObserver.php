<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Pricelist;
use Illuminate\Support\Facades\Cache;

/**
 * PricelistObserver
 *
 * Memantau perubahan data Pricelist (tambah/ubah/hapus paket harga).
 * Perubahan harga vendor akan mempengaruhi nilai C1 (Cost) pada kalkulasi SAW,
 * sehingga cache wajib dihapus.
 */
class PricelistObserver
{
    public function created(Pricelist $pricelist): void
    {
        $this->flushSawCache();
    }

    public function updated(Pricelist $pricelist): void
    {
        $this->flushSawCache();
    }

    public function deleted(Pricelist $pricelist): void
    {
        $this->flushSawCache();
    }

    private function flushSawCache(): void
    {
        try {
            Cache::tags(['saw'])->flush();
        } catch (\BadMethodCallException) {
            Cache::forget('categories_all');
        }
    }
}
