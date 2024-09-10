<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Harga;
use App\Models\Paket;
use App\Models\Destinasi;
use App\Models\Kendaraan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use App\Http\Requests\Main\Pemesanan\StorePemesananRequest;

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
     * Periksa ketersedian kendaraan.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function periksaKetersediaanKendaraan(Request $request): JsonResponse
    {
        $count = DB::table('unit_kendaraan')
            ->leftJoin('pesanan', function (JoinClause $join) use ($request): void {
                $join->on('pesanan.unit_kendaraan_id', '=', 'unit_kendaraan.id')
                    ->where('pesanan.tanggal_keberangkatan', '<=', $request->query('tanggal_kepulangan'))
                    ->where('pesanan.tanggal_kepulangan', '>=', $request->query('tanggal_keberangkatan'));
            })
            ->select('unit_kendaraan.*')
            ->where('unit_kendaraan.kendaraan_id', $request->query('kendaraan_id'))
            ->where('unit_kendaraan.status', 'tersedia')
            ->whereNull('pesanan.id')
            ->count();

        return response()->json([
            'data' => $count > 0 ? true : false,
        ]);
    }

    /**
     * Periksa harga kendaraan.
     *
     * @param Destinasi $destinasi
     * @param Kendaraan $kendaraan
     * @return JsonResponse
     */
    public function periksaHarga(Request $request): JsonResponse
    {
        /**
         * Select nominal pada tabel harga berdasarkan id_kendaraan
         * dan id_destinasi yang dipilih oleh member.
         */
        $harga = Harga::where('destinasi_id', $request->query('destinasi_id'))
            ->where('kendaraan_id', $request->query('kendaraan_id'))
            ->first();

        /**
         * Ambil nominal harga
         */
        $nominal = (int) $harga?->nominal;

        /**
         * Ambil selisih hari dari tanggal yang dipilih
         */
        $startDate = new DateTime($request->query('tanggal_keberangkatan'));
        $endDate = new DateTime($request->query('tanggal_kepulangan'));
        $diffDate = $startDate->diff($endDate)->days;

        /**
         * Kalikan nominal dengan jumlah hari
         */
        $total = ($diffDate + 1) * $nominal;

        return response()->json([
            'data' => [
                'harga_per_hari' => $nominal,
                'jumlah_hari' => $diffDate + 1,
                'total' => $total,
            ],
        ], 200);
    }

    /**
     * Tambah pesanan kendaraan.
     *
     * @param Request $request
     * @return void
     */
    public function store(StorePemesananRequest $request)
    {
        try {
            $pemesananBaru = $request->insert();

            return to_route('main.pesanan.show', ['pesanan' => $pemesananBaru->id])->with('alert', [
                'variant' => 'success',
                'message' => 'Pesanan anda berhasil dibuat.'
            ]);
        } catch (\Throwable $e) {
            return back()
                ->withInput($request->all())
                ->with('alert', [
                    'variant' => 'danger',
                    'message' => $e->getMessage(),
                ]);
        }
    }
}
