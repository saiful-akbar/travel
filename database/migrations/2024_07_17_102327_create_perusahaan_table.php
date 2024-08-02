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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama', 100)->nullable();
            $table->string('pt', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('telepon', 20)->unique()->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->text('alamat')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('profil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
