<?php

namespace Database\Seeders;

use App\Models\Harga;
use App\Models\Paket;
use App\Models\Destinasi;
use App\Models\Kendaraan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaketSeeder extends Seeder
{
    private function data(): array
    {
        return [
            [
                'nama' => 'Dalam Kota',
                'deskripsi' => 'Trip 1 hari PP',
                'aktif' => true,
                'destinasi' => [
                    [
                        'wilayah' => 'Antar/Jemput Bandara/Jakarta (all-in)',
                        'jumlah_hari' => 1,
                        'aktif' => true,
                    ],
                    [
                        'wilayah' => 'Dalam Kota Jakarta (fullday)',
                        'jumlah_hari' => 1,
                        'aktif' => true,
                    ],
                    [
                        'wilayah' => 'Bogor, Depok, Tangerang Kota, Bekasi',
                        'jumlah_hari' => 1,
                        'aktif' => true,
                    ],
                ],
            ],
            [
                'nama' => 'Luar Kota',
                'deskripsi' => 'Trip 1 hari PP',
                'aktif' => true,
                'destinasi' => [
                    [
                        'wilayah' => 'Cikarang, Tangerang, Karawaci, Cikupa',
                        'jumlah_hari' => 1,
                        'aktif' => true,
                    ],
                    [
                        'wilayah' => 'Puncak Bawah, Bogor, Ciawi, T. Safari',
                        'jumlah_hari' => 1,
                        'aktif' => true,
                    ],
                    [
                        'wilayah' => 'Puncak Atas, Sukabumi Kota, Anyar',
                        'jumlah_hari' => 1,
                        'aktif' => true,
                    ],
                ],
            ],
            [
                'nama' => 'Luar Kota/Menginap',
                'deskripsi' => 'Harga per hari',
                'aktif' => true,
                'destinasi' => [
                    [
                        'wilayah' => 'Cirebon, Kuningan, Tasik, Cianjur',
                        'jumlah_hari' => 2,
                        'aktif' => true,
                    ],
                    [
                        'wilayah' => 'Ujung Genteng, Pangandaran, Ciletuh',
                        'jumlah_hari' => 3,
                        'aktif' => true,
                    ],
                    [
                        'wilayah' => 'Jawa Tengah, Tegal, Slawi, Brebes',
                        'jumlah_hari' => 2,
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
        // Ambil data kendaraan
        $premio = Kendaraan::where('tipe', 'Hiace Premio')->first();
        $commuter = Kendaraan::where('tipe', 'Hiace Commuter')->first();

        foreach ($this->data() as $dataPaket) {
            // insert data paket
            $paket = Paket::create([
                'nama' => $dataPaket['nama'],
                'deskripsi' => $dataPaket['deskripsi'],
                'aktif' => $dataPaket['aktif'],
            ]);

            foreach ($dataPaket['destinasi'] as $dataDestinasi) {
                // insert data destinasi.
                $destinasi = $paket->destinasi()->create([
                    'wilayah' => $dataDestinasi['wilayah'],
                    'jumlah_hari' => $dataDestinasi['jumlah_hari'],
                    'aktif' => $dataDestinasi['aktif'],
                ]);

                // insert data harga
                Harga::create([
                    'kendaraan_id' => $premio->id,
                    'destinasi_id' => $destinasi->id,
                    'nominal' => 1000000
                ]);

                Harga::create([
                    'kendaraan_id' => $commuter->id,
                    'destinasi_id' => $destinasi->id,
                    'nominal' => 2000000
                ]);
            }
        }
    }
}
