<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Paket;
use App\Models\Pesanan;
use App\Models\Destinasi;
use App\Models\Kendaraan;
use App\Models\UnitKendaraan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Builder;

class PemesananController extends Controller
{
    /**
     * Menampilkan halaman pemesanan.
     *
     * @return View
     */
    public function index(): View
    {
        /**
         * Ambil data paket dan kendaraan
         */
        $paket = Paket::select('id', 'nama', 'deskripsi')->where('aktif', true)->get();
        $kendaraan = Kendaraan::whereRelation('unitKendaraan', 'status', '=', 'tersedia')->get();

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
        $unitTidakMemilikiPesanan = UnitKendaraan::leftJoin('pesanan', 'pesanan.unit_kendaraan_id', '=', 'unit_kendaraan.id')
            ->where('unit_kendaraan.kendaraan_id', $request->query('kendaraan_id'))
            ->where('unit_kendaraan.status', 'tersedia')
            ->whereNull('pesanan.id')
            ->count();

        if ($unitTidakMemilikiPesanan > 0) {
            return response()->json([
                'data' => true
            ]);
        }

        $query = UnitKendaraan::join('pesanan', 'pesanan.unit_kendaraan_id', '=', 'unit_kendaraan.id')
            ->where('unit_kendaraan.kendaraan_id', $request->query('kendaraan_id'))
            ->whereBetween('pesanan.tanggal_keberangkatan', [$request->query('tanggal_keberangkatan'), $request->query('tanggal_kepulangan')])
            ->orWhereBetween('pesanan.tanggal_kepulangan', [$request->query('tanggal_keberangkatan'), $request->query('tanggal_kepulangan')])
            ->orWhere(function (Builder $subQuery) use ($request): void {
                $subQuery->where('pesanan.tanggal_keberangkatan', '<=', $request->query('tanggal_keberangkatan'))
                    ->where('pesanan.tanggal_kepulangan', '>=', $request->query('tanggal_keberangkatan'));
            })
            ->orWhere(function (Builder $subQuery) use ($request): void {
                $subQuery->where('pesanan.tanggal_keberangkatan', '<=', $request->query('tanggal_kepulangan'))
                    ->where('pesanan.tanggal_kepulangan', '>=', $request->query('tanggal_kepulangan'));
            })
            ->count();

        return response()->json([
            'data' => $query === 0
        ]);
    }

    /**
     * Periksa harga kendaraan.
     *
     * @param Destinasi $destinasi
     * @param Kendaraan $kendaraan
     * @return JsonResponse
     */
    public function cekHarga(Request $request): JsonResponse
    {
        /**
         * Select nominal pada tabel harga berdasarkan id_kendaraan
         * dan id_destinasi yang dipilih oleh member.
         */
        $harga = Harga::where('destinasi_id', $request->query('destinasi'))
            ->where('kendaraan_id', $request->query('kendaraan'))
            ->first();

        return response()->json([
            'data' => (int) $harga?->nominal,
        ], 200);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
