<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Transaksi (Opsional, untuk fitur balasan vendor setelah transaksi selesai)
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
