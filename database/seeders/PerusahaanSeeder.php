<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Perusahaan::create([
            'nama' => 'Elang Trans',
            'pt' => 'PT. Elang Trans',
            'telepon' => '021 8889999',
            'email' => 'elangtrans@gmail.com',
            'alamat' => 'Jakarta, Indonesia',
        ]);
    }
}
