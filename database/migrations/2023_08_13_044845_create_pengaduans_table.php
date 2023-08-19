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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('kategori', ['reklame', 'oss_rba', 'sip_sik', 'imb_pbg', 'lainnya'])->default('lainnya');
            $table->string('nomor_referensi')->nullable();
            $table->date('tanggal_kejadian');
            $table->text('laporan');
            $table->string('alamat');
            $table->string('patokan')->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status', ['diajukan', 'ditolak_petugas', 'dikonfirmasi_petugas', 'diproses_petugas', 'diselesaikan_petugas', 'ditolak_pengadu', 'selesai'])->default('diajukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
