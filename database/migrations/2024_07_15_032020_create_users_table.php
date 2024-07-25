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
        Schema::create('user', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('email', 100)->unique()->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'member'])->default('Member');
            $table->boolean('aktif')->default(true);

            // Profil
            $table->string('foto', 100)->nullable();
            $table->string('nama_lengkap', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Kontak
            $table->string('telepon', 20)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->timestamps();
            $table->index('email');
            $table->index('telepon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
