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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->string("no_pemesanan");
            $table->integer('total_harga')->default(0);
            $table->integer('jumlah_hari')->default(0);
            $table->string('catatan')->nullable();
            $table->string('status')->default('proses')->comment('
                proses: pemesanan sedang berlangsung blm dikonfirmasi,
                Kofirmasi:sudah di konfirmsi oleh admin,
                Gagal:Gagal karena ditolak oleh admin');
            $table->string('status_pengembalian')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
