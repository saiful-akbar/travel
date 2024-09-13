<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'unit_kendaraan_id',
        'destinasi_id',
        'tanggal_keberangkatan',
        'tanggal_kepulangan',
        'alamat_tujuan',
        'alamat_penjemputan',
        'waktu_penjemputan',
        'latitude_penjemputan',
        'longitude_penjemputan',
        'catatan',
        'status',
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
    public function unitKendaraan(): BelongsTo
    {
        return $this->belongsTo(UnitKendaraan::class, 'unit_kendaraan_id', 'id');
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


    /**
     * Get the tagihan associated with the Pesanan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tagihan(): HasOne
    {
        return $this->hasOne(Tagihan::class, 'pesanan_id', 'id');
    }
}
