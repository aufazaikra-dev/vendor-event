<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['kode_pesanan', 'vendor_id', 'user_id', 'pricelist_id', 'status'];

    public function vendor() { return $this->belongsTo(Vendor::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function pricelist() { return $this->belongsTo(Pricelist::class); }
    public function review() { return $this->hasOne(Review::class); }
}
