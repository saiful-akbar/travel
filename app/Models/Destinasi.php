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
        'jumlah_hari',
        'aktif',
    ];

    /**
     * casts.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'aktif' => 'boolean'
        ];
    }

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
     * Get all of the harga for the Destinasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function harga(): HasMany
    {
        return $this->hasMany(Harga::class, 'destinasi_id', 'id');
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
