<?php

namespace App\Http\Controllers\Account;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return Response::json([
            'services' => Category::with('children')->get()->toTree(),
            'success'  => true,
        ], 200);
    }
}
