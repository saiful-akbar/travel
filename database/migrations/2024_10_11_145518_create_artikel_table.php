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
        Schema::create('artikel', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->foreignUlid('kategori_id')
                ->constrained('kategori')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('judul');
            $table->string('gambar', 100);
            $table->longText('konten');
            $table->boolean('publikasikan')->default(true);
            $table->timestamps();

            $table->fullText([
                'judul',
                'konten',
            ], 'artikel_fulltext');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
