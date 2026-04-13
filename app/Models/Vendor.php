<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    // Biar kita bisa isi semua kolom tanpa error
    protected $guarded = ['id'];

    // Relasi ke User (Pemilik Akun)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Kota
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relasi ke Paket Harga (Untuk SAW Kriteria Harga)
    public function pricelists()
    {
        return $this->hasMany(Pricelist::class);
    }

    // Relasi ke Review (Untuk SAW Kriteria Rating)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relasi ke Project (Untuk SAW Kriteria Portofolio)
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Relasi ke Alamat Vendor
    public function address()
    {
        return $this->hasOne(VendorAddress::class);
    }

    // Relasi ke Transaksi yang melibatkan Vendor ini
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
