<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Menampilkan detail spesifik satu vendor
    public function detailVendor($slug)
    {
        // Ambil data vendor beserta relasi portofolio, harga, dan review
        $vendor = Vendor::with(['projects', 'pricelists', 'reviews'])
                        ->where('slug', $slug)
                        ->firstOrFail(); // Kalau slug gak ketemu, otomatis error 404

        return view('detail_vendor', compact('vendor'));
    }
}
