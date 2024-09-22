<?php

namespace App\Http\Requests\Dashboard\Pesanan;

use App\Models\Pesanan;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DataTableRequest;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Http\FormRequest;

class PesananRequest extends FormRequest implements DataTableRequest
{
    public string $tanggalAwal;
    public string $tanggalAkhir;
    public string $status = 'Semua';

    /**
     * Menambahkan nilai pada properti $tanggalAwal dan $tangalAkhor.
     */
    public function __construct()
    {
        $this->tanggalAwal = date('Y-m-01');
        $this->tanggalAkhir = date('Y-m-t');
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validasi
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'tanggal_awal' => 'nullable|date',
            'tanggal_akhir' => 'required_with:tanggal_awal|date',
            'status' => 'nullable|in:Semua,Menunggu Pembayaran,Dibayar,Dikonfirmasi,Selesai,Dibatalkan',
        ];
    }

    /**
     * Update status pesanan yang sudah dikonfirmasi menjadi selesai jika tanggal saat ini
     * sudah melewati tanggal keberangkatan dan tanggal kepulangan.
     */
    private function statusSelesai(): void
    {
        Pesanan::where('status', 'Dikonfirmasi')
            ->where('tanggal_keberangkatan', '<', date('Y-m-d'))
            ->where('tanggal_kepulangan', '<', date('Y-m-d'))
            ->update(['status' => 'Selesai']);
    }

    /**
     * mengambil data pesanan untuk dataTable
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        /**
         * Update status menjadi selesai
         */
        $this->statusSelesai();

        /**
         * Periksa jika ada request tanggal_awal
         * ubah properti $tanggal_awal sesuai data yang di-request
         */
        if (!empty($this->query('tanggal_awal'))) {
            $this->tanggalAwal = $this->query('tanggal_awal');
        }

        /**
         * Periksa jika ada request tanggal_akhir
         * ubah properti $tanggal_akhir sesuai data yang di-request
         */
        if (!empty($this->query('tanggal_akhir'))) {
            $this->tanggalAkhir = $this->query('tanggal_akhir');
        }

        /**
         * Daftar kolom yang akan ditampilkan.
         */
        $columns = [
            'user.id as user_id',
            'user.foto as user_foto',
            'user.nama_lengkap as user_nama_lengkap',
            'user.email as user_email',
            'pesanan.id as pesanan_id',
            'pesanan.status as pesanan_status',
            'pesanan.created_at as pesanan_created_at',
            'pesanan.updated_at as updated_at',
            'tagihan.id as tagihan_id',
            'tagihan.jumlah as tagihan_jumlah',
            'tagihan.bukti_pembayaran as tagihan_bukti_pembayaran',
            'unit_kendaraan.id as unit_kendaraan_id',
            'unit_kendaraan.nomor as unit_kendaraan_nomor',
            'kendaraan.id as kendaraan_id',
            'kendaraan.merek as kendaraan_merek',
            'kendaraan.tipe as kendaraan_tipe',
            'destinasi.id as destinasi_id',
            'destinasi.wilayah as destinasi_wilayah',
        ];

        /**
         * Select data pesanan.
         */
        $query = Pesanan::select($columns)
            ->join('user', 'user.id', '=', 'pesanan.user_id')
            ->join('tagihan', 'tagihan.pesanan_id', 'pesanan.id')
            ->join('unit_kendaraan', 'unit_kendaraan.id', '=', 'pesanan.unit_kendaraan_id')
            ->join('kendaraan', 'kendaraan.id', '=', 'unit_kendaraan.kendaraan_id')
            ->join('destinasi', 'destinasi.id', '=', 'pesanan.destinasi_id')
            ->whereBetween('pesanan.created_at', [$this->tanggalAwal, $this->tanggalAkhir]);

        /**
         * Periksa jika ada request status dan value bukan Semua
         * ubah properti $status sesuai data yang di-request
         */
        if (!empty($this->query('status')) && $this->query('status') != 'Semua') {
            $query->where('pesanan.status', $this->query('status'));
        }

        /**
         * Datatable
         */
        return DataTables::of($query)
            ->addColumn('action', function (Pesanan $model) {
                return "
                    <a
                        href='" . route('dashboard.pesanan.show', ['pesanan' => $model->pesanan_id]) . "'
                        class='btn btn-sm btn-icon btn-info rounded-circle'
                        title='Detail Pesanan'
                    >
                        <i class='bi-eye'></i>
                    </a>
                    
                    <button
                        class='btn btn-sm btn-icon btn-danger rounded-circle'
                        type='button'
                        title='Hapus Pesanan'
                        onclick='return deletePesanan(`{$model->pesanan_id}`)'
                    >
                        <i class='bi-trash'></i>
                    </button>
                ";
            })->toJson();
    }
}
