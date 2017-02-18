<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ReviewController extends Controller
{
    public function getReviews()
    {
        return Response::json([
            'reviews' => \Auth::user()->company->reviews()->get(),
            'success'  => true,
        ], 200);
    }
}
