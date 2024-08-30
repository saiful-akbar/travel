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
                ->nullable()
                ->constrained('user')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUlid('supir_id')
                ->constrained('supir')
                ->restrictOnDelete()
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
            $table->decimal('total_tagihan', 15, 2)->default(0)->unsigned();
            $table->enum('status_pembayaran', ['pending', 'lunas', 'gagal'])->default('pending');

            $table->enum('status', [
                'dipesan',
                'dikonfirmasi',
                'dalam perjalanan',
                'selesai',
                'dibatalkan',
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
