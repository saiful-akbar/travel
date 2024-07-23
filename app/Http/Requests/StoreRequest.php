<?php

namespace App\Http\Requests;

interface StoreRequest
{
    /**
     * Method untuk insert data user baru
     *
     * @return void
     */
    public function insert(): void;
}
