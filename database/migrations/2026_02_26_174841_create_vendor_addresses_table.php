<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendor_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->text('jalan')->nullable(); // [cite: 2]
            $table->string('desa')->nullable(); // [cite: 2]
            // Membatasi pilihan kecamatan sesuai request [cite: 2]
            $table->enum('kecamatan', [
                'Baiturrahman', 'Banda Raya', 'Jaya Baru', 'Kuta Alam',
                'Kuta Raja', 'Lueng Bata', 'Meuraxa', 'Syiah Kuala', 'Ulee Kareng'
            ])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_addresses');
    }
};
