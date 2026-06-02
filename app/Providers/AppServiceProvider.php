<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Pricelist;
use App\Models\Review;
use App\Models\Vendor;
use App\Observers\PricelistObserver;
use App\Observers\ReviewObserver;
use App\Observers\VendorObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * Mendaftarkan Observer untuk invalidasi cache SAW secara otomatis
     * setiap kali terjadi perubahan (Create/Update/Delete) pada:
     * - Vendor      → mempengaruhi semua kriteria SAW
     * - Pricelist   → mempengaruhi C1 (Harga/Cost)
     * - Review      → mempengaruhi C2 (Rating/Benefit)
     */
    public function boot(): void
    {
        Vendor::observe(VendorObserver::class);
        Pricelist::observe(PricelistObserver::class);
        Review::observe(ReviewObserver::class);
    }
}
