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
        Schema::create('users', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['Admin', 'Member']);
            $table->boolean('aktif')->default(true);

            // Profil
            $table->string('foto', 50)->nullable();
            $table->string('nama_lengkap', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Kontak
            $table->string('telepon', 30)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->timestamps();
            $table->index('username');
            $table->index('email');
            $table->index('telepon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
