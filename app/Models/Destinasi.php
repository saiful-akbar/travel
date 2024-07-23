<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Destinasi extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'destinasi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'paket_id',
        'wilayah',
        'jumlah_hari'
    ];

    /**
     * Get the paket that owns the Destinasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
    }

    /**
     * The kendaraan that belong to the Destinasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function kendaraan(): BelongsToMany
    {
        return $this->belongsToMany(Kendaraan::class, 'kendaraan_destinasi', 'destinasi_id', 'kendaraan_id')
            ->using(KendaraanDestinasi::class)
            ->withPivot('harga')
            ->withTimestamps();
    }

    /**
     * Get all of the pesanan for the Destinasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'destinasi_id', 'id');
    }
}
