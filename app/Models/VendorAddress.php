<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorAddress extends Model
{
    protected $fillable = ['vendor_id', 'jalan', 'desa', 'kecamatan'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
