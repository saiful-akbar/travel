<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paket extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'paket';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama',
        'deskripsi',
        'aktif',
    ];

    /**
     * casts
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
        ];
    }

    /**
     * Get all of the destinasi for the Paket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinasi(): HasMany
    {
        return $this->hasMany(Destinasi::class, 'paket_id', 'id');
    }
}
