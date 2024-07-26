<?php

namespace Database\Seeders;

use App\Models\Paket;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaketSeeder extends Seeder
{
    private function data(): array
    {
        return [
            [
                'nama' => 'Dalam Kota',
                'aktif' => true,
                'destinasi' => [
                    [
                        'wilayah' => 'Jakarta',
                        'jumlah_hari' => 1,
                        'aktif' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data() as $paket) {
            Paket::create(['nama' => $paket['nama']])
                ->destinasi()
                ->createMany($paket['destinasi']);
        }
    }
}
