<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Pricelist;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // ================= SISI VENDOR =================
    public function vendorIndex()
    {
        $vendor = auth()->user()->vendor;
        // Ambil transaksi milik vendor ini
        $transactions = Transaction::with(['user', 'pricelist', 'review'])->where('vendor_id', $vendor->id)->latest()->get();

        // Ambil data pelanggan (user) dan paket untuk dropdown form
        $users = User::where('role', 'user')->get();
        $pricelists = Pricelist::where('vendor_id', $vendor->id)->get();

        return view('vendor.transactions', compact('transactions', 'users', 'pricelists'));
    }

    public function vendorStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pricelist_id' => 'required|exists:pricelists,id',
        ]);

        $vendor = auth()->user()->vendor;
        // Generate Kode Pesanan Otomatis (Contoh: ORD-20260227-ABCD)
        $kode = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        Transaction::create([
            'kode_pesanan' => $kode,
            'vendor_id' => $vendor->id,
            'user_id' => $request->user_id,
            'pricelist_id' => $request->pricelist_id,
            'status' => 'sedang_dilaksanakan', // Status awal otomatis
        ]);

        return back()->with('success', 'Pesanan berhasil ditambahkan! Pelanggan sekarang bisa melihatnya di riwayat mereka.');
    }

    public function vendorUpdateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // ================= SISI PELANGGAN (USER) =================
    public function userIndex()
    {
        $userId = auth()->id();

        // Hitung stats dari semua data (bukan dari paginator)
        $totalPesanan  = Transaction::where('user_id', $userId)->count();
        $totalSelesai  = Transaction::where('user_id', $userId)->where('status', 'selesai')->count();
        $totalBerjalan = Transaction::where('user_id', $userId)->where('status', '!=', 'selesai')->count();

        // Ambil riwayat pesanan dengan pagination (6 per halaman)
        $transactions = Transaction::with(['vendor', 'pricelist', 'review'])
            ->where('user_id', $userId)
            ->latest()
            ->paginate(6);

        return view('user.transactions', compact('transactions', 'totalPesanan', 'totalSelesai', 'totalBerjalan'));
    }
}
