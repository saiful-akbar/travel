<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pesanan;
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
        $data = [
            [
                'status' => 'Menunggu Pembayaran',
                'month' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'value' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            ],
            [
                'status' => 'Dibayar',
                'month' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'value' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            ],
            [
                'status' => 'Dikonfirmasi',
                'month' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'value' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            ],
            [
                'status' => 'Selesai',
                'month' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'value' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            ],
            [
                'status' => 'Dibatalkan',
                'month' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'value' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            ],
        ];

        $pesanan = Pesanan::select('status')
            ->selectRaw("date_format(created_at, '%b') as month")
            ->selectRaw('count(status) as total')
            ->whereRaw('year(created_at) = ?', date('Y'))
            ->groupBy('status', 'month')
            ->get();

        foreach ($pesanan as $keyPesanan => $valuePesanan) {
            foreach ($data as $keyData => $valueData) {
                if ($valuePesanan->status == $valueData['status']) {
                    $data[$keyData]['value'][array_search($valuePesanan->month, $valueData['month'])] = $valuePesanan->total;
                }
            }
        }

        return view('pages.dashboard.home.index', compact('data'));
    }
}
