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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email');
            $table->string('password');
            $table->string('no_telepon_user')->nullable();;
            $table->enum('role', ['admin', 'pelanggan', 'petani']);
            $table->string('provinsi_user')->nullable();
            $table->string('kabupaten_user')->nullable();
            $table->string('kecamatan_user')->nullable();
            $table->string('kode_pos_user')->nullable();
            $table->text('detail_alamat_user')->nullable();
            $table->int('saldo')->nullable();
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
        Schema::dropIfExists('users');
    }
};
