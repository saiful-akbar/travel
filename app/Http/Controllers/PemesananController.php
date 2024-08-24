<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Paket;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Menampilkan halaman pemesanan.
     *
     * @return View
     */
    public function index(): View
    {
        $paket = Paket::select('id', 'nama', 'deskripsi')
            ->where('aktif', true)
            ->get();

        $kendaraan = Kendaraan::whereRelation('unitKendaraan', 'status', '=', 'tersedia')
            ->get();


        return view('pages.main.pemesanan.index', compact('paket', 'kendaraan'));
    }

    /**
     * Mengambil data destinasi berdasarkan paket_id.
     *
     * @return JsonResponse
     */
    public function getDestinasiJson(Paket $paket): JsonResponse
    {
        $columns = ['id', 'paket_id', 'wilayah'];
        $destinasi = $paket->destinasi()->select($columns)->get();

        return response()->json([
            'data' => $destinasi,
        ], 200);
    }

    /**
     * Memmeriksa ketersedian kendaraan.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function cekKetersediaanKendaraan(Request $request): JsonResponse
    {
        /**
         * SQL untuk memeriksa ketersediaan kendaraan
         * yang dipesan berdasarkan tanggal keberangkatan,
         * tanggal kepulangan dan kendaraan yang dipilih.
         * 
         * SQL:
         * select `pesanan`.`id` from `pesanan`
         * left join `unit_kendaraan` on `unit_kendaraan`.`id` = `pesanan`.`unit_kendaraan_id`
         * where `unit_kendaraan`.`kendaraan_id` = '01j5zzhc6ftmmgfkm1n9tcz9s5' and (
         *      `pesanan`.`tanggal_keberangkatan` between '2024-08-16' and '2024-08-16'
         *      or `pesanan`.`tanggal_kepulangan` between '2024-08-16' and '2024-08-16'
         *      or (`pesanan`.`tanggal_keberangkatan` <= '2024-08-16' and `pesanan`.`tanggal_kepulangan` >= '2024-08-16')
         *      or (`pesanan`.`tanggal_keberangkatan` <= '2024-08-16' and `pesanan`.`tanggal_kepulangan` >= '2024-08-16')
         * );
         */
        $count = Pesanan::select('pesanan.id')
            ->leftJoin('unit_kendaraan', 'unit_kendaraan.id', '=', 'pesanan.unit_kendaraan_id')
            ->where('unit_kendaraan.kendaraan_id', $request->query('kendaraan_id'))
            ->where(function (Builder $query) use ($request): void {
                $query->whereBetween('pesanan.tanggal_keberangkatan', [$request->tanggal_keberangkatan, $request->tanggal_keberangkatan])
                    ->orWhereBetween('pesanan.tanggal_kepulangan', [$request->tanggal_keberangkatan, $request->tanggal_keberangkatan])
                    ->orWhere(function (Builder $subQuery) use ($request): void {
                        $subQuery->where('pesanan.tanggal_keberangkatan', '<=', $request->tanggal_keberangkatan)
                            ->where('pesanan.tanggal_kepulangan', '>=', $request->tanggal_keberangkatan);
                    })
                    ->orWhere(function (Builder $subQuery) use ($request): void {
                        $subQuery->where('pesanan.tanggal_keberangkatan', '<=', $request->tanggal_kepulangan)
                            ->where('pesanan.tanggal_kepulangan', '>=', $request->tanggal_kepulangan);
                    });
            })->get();

        return response()->json([
            'data' => $count,
        ], 200);
    }
}
