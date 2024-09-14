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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignUlid('pesanan_id')
                ->constrained('pesanan')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->decimal('jumlah', 15, 2)->unsigned()->default(0);
            $table->timestamp('tanggal_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
