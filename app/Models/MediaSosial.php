<?php

namespace App\Models;

use App\Traits\HasTimestamp;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaSosial extends Model
{
    use HasFactory, HasUlids, HasTimestamp;

    protected $table = 'media_sosial';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama',
        'url',
        'icon',
    ];
}
