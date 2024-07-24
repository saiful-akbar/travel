<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * The destinasi that belong to the Kendaraan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function destinasi(): BelongsToMany
    {
        return $this->belongsToMany(Destinasi::class, 'kendaraan_destinasi', 'kendaraan_id', 'destinasi_id')
            ->using(KendaraanDestinasi::class)
            ->withPivot('harga')
            ->withTimestamps();
    }
}
