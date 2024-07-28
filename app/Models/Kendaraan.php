<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kendaraan extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'kendaraan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'merek',
        'tipe',
        'kapasitas',
        'gambar',
        'dekripsi',
    ];

    /**
     * Get all of the unitKendaraan for the Kendaraan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unitKendaraan(): HasMany
    {
        return $this->hasMany(UnitKendaraan::class, 'kendaraan_id', 'id');
    }

    /**
     * Get all of the harga for the Kendaraan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function harga(): HasMany
    {
        return $this->hasMany(Harga::class, 'kendaraan_id', 'id');
    }
}
