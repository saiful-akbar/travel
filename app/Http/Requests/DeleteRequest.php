<?php

namespace App\Http\Requests;


interface DeleteRequest
{
    public function destroy(): int;
}
