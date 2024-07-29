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
        Schema::create('harga', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignUlid('kendaraan_id')
                ->constrained('kendaraan')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignUlid('destinasi_id')
                ->constrained('destinasi')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->decimal('nominal', 15, 2)->default(0)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga');
    }
};
