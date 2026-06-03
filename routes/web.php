<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\VendorAuthController;
use App\Http\Controllers\PricelistController;
use App\Http\Controllers\VendorProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;

// ==========================================
// 1. HALAMAN UTAMA & REGISTER (PUBLIK)
// ==========================================
Route::get('/', [RecommendationController::class, 'index'])->name('home');

// ==========================================
// DEBUG ROUTE - HAPUS SETELAH SELESAI DEBUG
// ==========================================
Route::get('/debug-admin', function () {
    $user = \Illuminate\Support\Facades\DB::table('users')
        ->where('email', 'admin@eventvendor.com')
        ->first();

    if (!$user) {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'              => 'Admin',
            'email'             => 'admin@eventvendor.com',
            'email_verified_at' => now(),
            'password'          => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role'              => 'admin',
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
        return response()->json(['status' => 'CREATED', 'message' => 'Admin user baru dibuat. Silakan login sekarang.']);
    }

    \Illuminate\Support\Facades\DB::table('users')
        ->where('email', 'admin@eventvendor.com')
        ->update([
            'password'          => \Illuminate\Support\Facades\Hash::make('admin123'),
            'email_verified_at' => now(),
            'role'              => 'admin',
            'updated_at'        => now(),
        ]);

    return response()->json([
        'status'      => 'UPDATED',
        'user_found'  => true,
        'id'          => $user->id,
        'name'        => $user->name,
        'email'       => $user->email,
        'role'        => $user->role,
        'verified_at' => $user->email_verified_at,
        'message'     => 'Password admin sudah direset ke admin123. Silakan login sekarang.',
    ]);
});

Route::get('/seed-dummy-data', function () {
    try {
        \Artisan::call('db:seed', [
            '--class' => 'VendorAndCustomerSeeder',
            '--force' => true,
        ]);
        return response()->json([
            'status'  => 'SUCCESS',
            'message' => 'Data dummy vendor dan pelanggan berhasil di-seed!',
            'output'  => \Artisan::output(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'ERROR',
            'message' => $e->getMessage(),
        ], 500);
    }
});

Route::get('/list-vendor-credentials', function () {
    $vendors = \Illuminate\Support\Facades\DB::table('users')
        ->where('role', 'vendor')
        ->orderBy('id')
        ->get(['id', 'name', 'email']);

    $list = $vendors->map(function ($u) {
        $firstName = strtolower(explode(' ', $u->name)[0]);
        return [
            'nama'     => $u->name,
            'email'    => $u->email,
            'password' => $firstName . '123',
        ];
    });

    return response()->json([
        'total'   => $vendors->count(),
        'vendors' => $list,
    ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
});
// ==========================================


Route::middleware('guest')->group(function () {
    Route::get('/register-vendor', [VendorAuthController::class, 'showRegisterForm'])->name('vendor.register');
    Route::post('/register-vendor', [VendorAuthController::class, 'register']);
});

// ==========================================
// 2. AREA WAJIB LOGIN (AUTH MIDDLEWARE)
// ==========================================
Route::middleware(['auth'])->group(function () {

    // --- RUTE TERMINAL DASHBOARD (Pencegah Error Breeze) ---
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'vendor') {
            return redirect()->route('vendor.dashboard');
        }
        return redirect()->route('home'); // Untuk user biasa
    })->name('dashboard');
    // -------------------------------------------------------

    // --- AREA VENDOR ---
    Route::middleware(['role:vendor'])->group(function () {
        Route::get('/vendor/dashboard', function () {
            $vendor = auth()->user()->vendor;
            // Ambil total paket dan rata-rata rating dari database
            $total_paket = $vendor ? $vendor->pricelists()->count() : 0;
            $rating = $vendor ? $vendor->reviews()->avg('rating') : 0;

            return view('vendor.dashboard', compact('vendor', 'total_paket', 'rating'));
        })->name('vendor.dashboard');

        Route::resource('vendor/paket', PricelistController::class);
        Route::get('/vendor/profil', [VendorProfileController::class, 'edit'])->name('vendor.profile');
        Route::put('/vendor/profil', [VendorProfileController::class, 'update'])->name('vendor.profile.update');
        Route::resource('vendor/portofolio', ProjectController::class);
    });

    // --- AREA ADMIN ---
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/vendor', [\App\Http\Controllers\AdminController::class, 'vendors'])->name('admin.vendors');
        Route::post('/admin/vendor/{id}/verify', [\App\Http\Controllers\AdminController::class, 'verify'])->name('admin.vendor.verify');
        Route::post('/admin/vendor/{id}/unverify', [\App\Http\Controllers\AdminController::class, 'unverify'])->name('admin.vendor.unverify');
        Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    });

    // --- TAMBAHAN FASE 2: RUTE TRANSAKSI & REVIEW ---

    // Rute Vendor: Kelola Pesanan & Balas Ulasan
    Route::middleware(['role:vendor'])->group(function () {
        Route::get('/vendor/pesanan', [\App\Http\Controllers\TransactionController::class, 'vendorIndex'])->name('vendor.transactions');
        Route::post('/vendor/pesanan', [\App\Http\Controllers\TransactionController::class, 'vendorStore'])->name('vendor.transactions.store');
        Route::put('/vendor/pesanan/{id}', [\App\Http\Controllers\TransactionController::class, 'vendorUpdateStatus'])->name('vendor.transactions.update');
        Route::put('/vendor/review/{id}/reply', [\App\Http\Controllers\ReviewController::class, 'vendorReply'])->name('vendor.review.reply');
    });

    // Rute User (Pelanggan): Riwayat Pesanan & Form Ulasan
    Route::get('/user/pesanan', [\App\Http\Controllers\TransactionController::class, 'userIndex'])->name('user.transactions');
    Route::post('/user/pesanan/{transaction_id}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('user.review.store');

    // --- TAMBAHKAN 3 BARIS INI (Bawaan Breeze yang terhapus) ---
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    // -----------------------------------------------------------

    // --- FITUR RATING USER ---
    Route::post('/vendor/{vendor_id}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
});

// ==========================================
// 3. RUTE WILDCARD (HARUS PALING BAWAH!)
// ==========================================
// Rute {slug} ditaruh paling bawah agar tidak "memakan" rute /vendor/dashboard dkk.
Route::get('/vendor/{slug}', [FrontendController::class, 'detailVendor'])->name('frontend.vendor.detail');

// Load rute bawaan Breeze
require __DIR__.'/auth.php';
