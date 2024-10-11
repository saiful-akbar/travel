<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'kategori';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama'
    ];

    /**
     * Get all of the artikel for the Kategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function artikel(): HasMany
    {
        return $this->hasMany(Artikel::class, 'kategori_id', 'id');
    }
}
