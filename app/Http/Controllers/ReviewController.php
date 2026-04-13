<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // User memberi rating berdasarkan ID Transaksi
    public function store(Request $request, $transaction_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        $transaction = Transaction::findOrFail($transaction_id);

        // Validasi Ekstra: Pastikan statusnya selesai dan belum direview
        if ($transaction->status !== 'selesai') {
            return back()->with('error', 'Pesanan belum selesai. Anda belum bisa memberikan ulasan.');
        }
        if ($transaction->review) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk pesanan ini.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'vendor_id' => $transaction->vendor_id,
            'transaction_id' => $transaction->id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }

    // Vendor membalas ulasan
    public function vendorReply(Request $request, $id)
    {
        $request->validate(['balasan_vendor' => 'required|string|max:500']);
        $review = Review::findOrFail($id);

        $review->update(['balasan_vendor' => $request->balasan_vendor]);

        return back()->with('success', 'Balasan ulasan berhasil dikirim!');
    }
}
