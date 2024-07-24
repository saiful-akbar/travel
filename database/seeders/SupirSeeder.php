<?php

namespace Database\Seeders;

use App\Models\Supir;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supir::create([
            'nama_lengkap' => 'Wanto',
            'jenis_kelamin' => 'L'
        ]);
    }
}
