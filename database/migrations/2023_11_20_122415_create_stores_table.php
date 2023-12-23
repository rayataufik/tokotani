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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->constrained('users');
            $table->string('nama_toko');
            $table->string('slug')->unique();
            $table->text('photo_toko');
            $table->string('provinsi_toko')->nullable();
            $table->string('kabupaten_toko')->nullable();
            $table->string('kecamatan_toko')->nullable();
            $table->string('kode_pos_toko')->nullable();
            $table->text('detail_alamat_toko')->nullable();
            $table->unsignedInteger('saldo')->nullable();
            $table->enum('status_penarikan_saldo', ['diproses', 'selesai'])->nullable();
            $table->string('bank')->nullable();
            $table->string('no_rekening')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
