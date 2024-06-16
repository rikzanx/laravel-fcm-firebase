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
        Schema::create('pemesanan_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id')->index();
            $table->unsignedBigInteger('barang_id')->index();
            $table->integer('harga')->default(0);
            $table->integer('jumlah')->default(0);
            $table->integer('jumlah_hari')->default(0);
            $table->integer('sub_total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_items');
    }
};
