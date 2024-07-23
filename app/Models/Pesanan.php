<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'pesanan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'supir_id',
        'kendaraan_id',
        'destinasi_id',
        'tanggal_keberangkatan',
        'tanggal_kepulangan',
        'waktu_penjemputan',
        'lokasi_penjemputan',
        'latitude_penjemputan',
        'longitude_penjemputan',
        'total_tagihan',
        'status_pembayaran',
    ];

    /**
     * Get the user that owns the Pesanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the supir that owns the Pesanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supir(): BelongsTo
    {
        return $this->belongsTo(Supir::class, 'supir_id', 'id');
    }

    /**
     * Get the kendaraan that owns the Pesanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id', 'id');
    }

    /**
     * Get the destinasi that owns the Pesanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinasi(): BelongsTo
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id', 'id');
    }
}
