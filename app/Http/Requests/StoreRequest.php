<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;

interface StoreRequest
{
    /**
     * Undocumented function
     *
     * @return Model|null
     */
    public function insert(): ?Model;
}
