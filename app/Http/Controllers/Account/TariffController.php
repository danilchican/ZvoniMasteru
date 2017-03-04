<?php

namespace App\Http\Controllers\Account;

use App\Models\Tariff;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class TariffController extends Controller
{
    public function getTariffs()
    {
        return Response::json([
            'tariffs' => Tariff::published()->with('prices', 'services')->get(),
            'success'  => true,
        ], 200);
    }
}
