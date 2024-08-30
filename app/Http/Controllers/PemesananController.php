<?php

namespace App\Http\Controllers;

use App\Http\Requests\Main\Pemesanan\StorePemesananRequest;
use App\Models\Harga;
use App\Models\Paket;
use App\Models\Destinasi;
use App\Models\Kendaraan;
use App\Models\UnitKendaraan;
use DateTime;
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
     * select tabel unit_kendaraan dan left join dengan tabel pesanan.
     * ambil data unit kendaraan berdasarkan kendaraan_id yang dipilih oleh user.
     * lalu ambil unit kendaraan yang tidak memiliki pesanan atau unit kendaraan yang
     * memiliki pesanan dengan status bukan "dalam perjalanan" dan periode tanggal kepergian
     * dan tanggal kepulangaannya tidak berbentrokan dengan tanggal kepergian dan tanggal kepulangan
     * yang dipilih oleh user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function cekKetersediaanKendaraan(Request $request): JsonResponse
    {
        /**
         * Join tabel unit_kendaraan dengan tabel pesanan.
         */
        $query = Unitkendaraan::leftJoin('pesanan', 'pesanan.unit_kendaraan_id', '=', 'unit_kendaraan.id');

        /**
         * filter data berdasarkan id kendaraan yang yang dilih oleh user
         * dari tabel unit_kendaraan.
         */
        $query->where('unit_kendaraan.kendaraan_id', $request->query('kendaraan_id'));

        /**
         * Filter data berdasarkan status dari unit_kendaraan yang tersedia.
         */
        $query->where('unit_kendaraan.status', 'tersedia');

        /**
         * Filter juga data berdasarkan id pesanan yang bernilai null
         * atau status pesanan yang bukan "dalam perjalanan" dan
         * periode tanggal yang dipili user tidak berbentrokan dengan
         * jadwal pesanan yang sudah ada.
         */
        $query->where(function (Builder $subQuery) use ($request): void {
            $subQuery->whereNull('pesanan.id')
                ->orWhere(function (Builder $subQuery) use ($request): void {
                    $subQuery->where('pesanan.status', '<>', 'dalam perjalanan')
                        ->whereNotBetween('pesanan.tanggal_keberangkatan', [$request->query('tanggal_keberangkatan'), $request->query('tanggal_kepulangan')])
                        ->whereNotBetween('pesanan.tanggal_kepulangan', [$request->query('tanggal_keberangkatan'), $request->query('tanggal_kepulangan')]);
                });
        });

        return response()->json([
            'data' => (bool) $query->count() > 0
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
        $request->insert();

        return to_route('main.pemesanan')->with('alert', [
            'variant' => 'success',
            'message' => 'Pesanan anda berhasil ditambahkan.'
        ]);
    }
}
