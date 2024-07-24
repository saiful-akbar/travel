<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasTimestamp
{
    /**
     * Merubah format created_at
     *
     * @return Attribute
     */
    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)
                ->timezone(config('app.timezone'))
                ->format('d M Y, H:i'),
        );
    }

    /**
     * Merubah format updated_at
     *
     * @return Attribute
     */
    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)
                ->timezone(config('app.timezone'))
                ->format('d M Y, H:i'),
        );
    }
}
