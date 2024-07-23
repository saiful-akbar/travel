<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
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
        'nomor_kendaraan'
    ];

    /**
     * Get the kendaraan that owns the UnitKendaraan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id', 'id');
    }
}
