<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Supir;
use App\Models\Pesanan;
use App\Models\Destinasi;
use App\Models\UnitKendaraan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::select('id')->where('email', 'member@gmail.com')->first();
        $supir = Supir::select('id')->first();
        $unit_kendaraan = UnitKendaraan::select('id')->first();
        $destinasi = Destinasi::select('id')->first();

        Pesanan::create([
            'user_id' => $user->id,
            'supir_id' => $supir->id,
            'unit_kendaraan_id' => $unit_kendaraan->id,
            'destinasi_id' => $destinasi->id,
            'tanggal_keberangkatan' => date('Y-m-d'),
            'tanggal_kepulangan' => date('Y-m-d'),
            'waktu_penjemputan' => date('H:i:s'),
            'lokasi_penjemputan' => 'Jl. Dewi Sartika, Ciputat',
        ]);
    }
}
