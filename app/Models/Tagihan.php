<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tagihan extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'tagihan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'pesanan_id',
        'status',
        'jumlah',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'catatan',
    ];

    /**
     * Get the pesanan that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }

    /**
     * Merubah value dari field jumlah.
     *
     * @return Attribute
     */
    public function jumlah(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (float) $value
        );
    }
}
