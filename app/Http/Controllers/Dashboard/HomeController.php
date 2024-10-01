<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman home dashboard
     *
     * @return View
     */
    public function index(): View
    {
        $sql = " SELECT status_enum.status, COALESCE(COUNT(pesanan.status), 0) AS `total`
        FROM (
            SELECT 'Menunggu Pembayaran' AS status
            UNION ALL
            SELECT 'Dibayar'
            UNION ALL
            SELECT 'Dikonfirmasi'
            UNION ALL
            SELECT 'Delesai'
            UNION ALL
            SELECT 'Dibatalkan'
        ) AS status_enum
        LEFT JOIN pesanan ON pesanan.status = status_enum.status
        GROUP BY status_enum.status";

        $statusPesanan = DB::select($sql);

        return view('pages.dashboard.home.index', compact('statusPesanan'));
    }
}
