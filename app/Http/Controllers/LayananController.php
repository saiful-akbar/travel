<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Kendaraan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LayananController extends Controller
{
    /**
     * Menampilkan halaman layanan.
     *
     * @return View
     */
    public function index()
    {
        /**
         * Select data peket beserta destinasinya
         * lalu join dengan tabel harga untuk mengambil
         * harga termahal dan harga termurah untuk setiap destinasi.
         */
        $pakets = Paket::with([
            'destinasi' => function (HasMany $query): void {
                $query->select(
                    'destinasi.id as id',
                    'destinasi.paket_id as paket_id',
                    'destinasi.wilayah as wilayah',
                    'destinasi.jumlah_hari as jumlah_hari',
                    DB::raw('FLOOR(MIN(harga.nominal)) as harga_minimum'),
                    DB::raw('FLOOR(MAX(harga.nominal)) as harga_maksimum'),
                )
                    ->join('harga', 'harga.destinasi_id', '=', 'destinasi.id')
                    ->where('destinasi.aktif', true)
                    ->groupBy('destinasi.id')
                    ->orderBy('destinasi.wilayah', 'asc');
            }
        ])
            ->select('id', 'nama')
            ->where('aktif', true)
            ->orderBy('nama', 'asc')
            ->get();

        /**
         * Select data kendaraan
         */
        $kendaraans = Kendaraan::select('id', 'merek', 'tipe', 'kapasitas', 'gambar')
            ->orderBy('merek', 'asc')
            ->orderBy('tipe', 'asc')
            ->get();

        return view('pages.main.layanan.index', compact('pakets', 'kendaraans'));
    }
}
