<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supir extends Model
{
    use HasFactory, HasUuids, HasTimestamp;

    protected $table = 'supir';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'foto',
        'nama_lengkap',
        'tanggal_lahir',
    ];

    /**
     * Get all of the pesanan for the Supir
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'supir_id', 'id');
    }
}
