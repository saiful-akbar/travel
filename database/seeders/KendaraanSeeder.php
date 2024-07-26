<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KendaraanSeeder extends Seeder
{
    private function kendaraan(): array
    {
        return [
            [
                'merek' => 'Honda',
                'tipe' => 'CRV',
                'kapasitas' => 8,
                'unit' => [
                    [
                        'tahun' => 2020,
                        'nomor' => 'B 123 ABC',
                    ],
                ]
            ],
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->kendaraan() as $kendaraan) {
            Kendaraan::create([
                'merek' => $kendaraan['merek'],
                'tipe' => $kendaraan['tipe'],
                'kapasitas' => $kendaraan['kapasitas'],
            ])->unitKendaraan()->createMany($kendaraan['unit']);
        }
    }
}
