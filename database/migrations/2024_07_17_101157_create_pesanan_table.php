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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignUlid('user_id')
                ->constrained('user')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUlid('supir_id')
                ->nullable()
                ->constrained('supir')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUlid('unit_kendaraan_id')
                ->constrained('unit_kendaraan')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUlid('destinasi_id')
                ->constrained('destinasi')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->date('tanggal_keberangkatan');
            $table->date('tanggal_kepulangan');
            $table->text('alamat_tujuan');
            $table->text('alamat_penjemputan');
            $table->time('waktu_penjemputan');
            $table->string('latitude_penjemputan', 20)->nullable();
            $table->string('longitude_penjemputan', 20)->nullable();

            $table->enum('status', [
                'Dipesan',
                'Konfirmasi',
                'Proses',
                'Selesai',
                'Batal',
            ])->default('dipesan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
