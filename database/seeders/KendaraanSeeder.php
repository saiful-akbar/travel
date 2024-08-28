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
                'merek' => 'Toyota',
                'tipe' => 'Hiace Premio',
                'kapasitas' => 10,
                'unit' => [
                    [
                        'tahun' => 2020,
                        'nomor' => 'B 123 ABC',
                    ],
                    [
                        'tahun' => 2020,
                        'nomor' => 'B 456 BCD',
                    ],
                    [
                        'tahun' => 2020,
                        'nomor' => 'B 789 BCD',
                    ],
                ]
            ],
            [
                'merek' => 'Toyota',
                'tipe' => 'Hiace Commuter',
                'kapasitas' => 10,
                'unit' => [
                    [
                        'tahun' => 2021,
                        'nomor' => 'B 123 DEF',
                    ],
                    [
                        'tahun' => 2021,
                        'nomor' => 'B 456 DEF',
                    ],
                    [
                        'tahun' => 2021,
                        'nomor' => 'B 789 DEF',
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
            $result = Kendaraan::create([
                'merek' => $kendaraan['merek'],
                'tipe' => $kendaraan['tipe'],
                'kapasitas' => $kendaraan['kapasitas'],
            ]);

            $result->unitKendaraan()->createMany($kendaraan['unit']);
        }
    }
}
