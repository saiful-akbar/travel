<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitKendaraan extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'unit_kendaraan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kendaraan_id',
        'tahun',
        'nomor',
        'status',
    ];

    /**
     * Merubah value nomor ketika di-insert.
     *
     * @return Attribute
     */
    public function nomor(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Get the kendaraan that owns the UnitKendaraan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id', 'id');
    }

    /**
     * Get all of the pesanan for the Kendaraan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'unit_kendaraan_id', 'id');
    }
}
