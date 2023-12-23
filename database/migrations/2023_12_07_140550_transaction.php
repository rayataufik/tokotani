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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('midtrans_id')->nullable();
            $table->enum('status', ['paid', 'unpaid', 'diproses', 'dikirim', 'selesai', 'dibatalkan']);
            $table->enum('menunggu_pembatalan', ['dibatalkan', 'menunggu'])->nullable();
            $table->enum('cek_is_refund', ['refunded'])->nullable();
            $table->int('total_harga');
            $table->int('total_ongkir');
            $table->int('total_tagihan');
            $table->string('metode_pembayaran');
            $table->string('jasa_pengiriman');
            $table->string('resi_pengiriman')->nullable();
            $table->string('va_number')->nullable();
            $table->string('expiry_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
