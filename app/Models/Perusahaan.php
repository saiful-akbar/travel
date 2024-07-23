<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perusahaan extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'perusahaan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama',
        'logo',
        'telepon',
        'email',
        'alamat',
    ];

    /**
     * Merubah value logo saat diambil.
     *
     * @return Attribute
     */
    public function logo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? null : storage($value),
        );
    }
}
