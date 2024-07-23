<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;

interface DataTableRequest
{
    public function dataTable(): JsonResponse;
}
