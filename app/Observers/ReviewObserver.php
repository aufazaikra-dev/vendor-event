<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;

/**
 * ReviewObserver
 *
 * Memantau perubahan data Review (ulasan baru, edit rating, hapus ulasan).
 * Perubahan rating akan mempengaruhi nilai C2 (Rating) pada kalkulasi SAW,
 * sehingga cache wajib dihapus.
 */
class ReviewObserver
{
    public function created(Review $review): void
    {
        $this->flushSawCache();
    }

    public function updated(Review $review): void
    {
        $this->flushSawCache();
    }

    public function deleted(Review $review): void
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
