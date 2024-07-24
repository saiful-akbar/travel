<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supir extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'supir';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'foto',
        'nama_lengkap',
        'jenis_kelamin',
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
