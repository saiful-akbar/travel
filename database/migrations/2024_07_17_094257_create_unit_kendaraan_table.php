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
        Schema::create('unit_kendaraan', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignUlid('kendaraan_id')
                ->constrained('kendaraan')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->year('tahun');
            $table->string('nomor_kendaraan', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_kendaraan');
    }
};
