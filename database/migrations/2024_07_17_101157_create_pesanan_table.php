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
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUlid('supir_id')
                ->constrained('supir')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUlid('kendaraan_id')
                ->constrained('kendaraan')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUlid('destinasi_id')
                ->constrained('destinasi')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->date('tanggal_keberangkatan');
            $table->date('tanggal_kepulangan');
            $table->time('waktu_penjemputan');
            $table->text('lokasi_penjemputan');
            $table->string('latitude_penjemputan', 20)->nullable();
            $table->string('longitude_penjemputan', 20)->nullable();
            $table->decimal('total_tagihan', 15, 2)->default(0)->unsigned();
            $table->enum('status_pembayaran', ['Belum Bayar', 'Lunas'])->default('Belum Bayar');
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
