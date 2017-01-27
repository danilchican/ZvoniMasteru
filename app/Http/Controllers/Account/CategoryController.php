<?php

namespace App\Http\Controllers\Account;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    /**
     * Get all categories in Tree.
     *
     * @return mixed
     */
    public function getCategories()
    {
        return Response::json([
            'services' => Category::with('children')->get()->toTree(),
            'success'  => true,
        ], 200);
    }

    /**
     * Get attached categories to company.
     *
     * @return mixed
     */
    public function getAttachedCategories()
    {
        return Response::json([
            'services' => \Auth::user()->company->categories()->get()->pluck('id')->toArray(),
            'success'  => true,
        ], 200);
    }

    /**
     * Toggle category for a company.
     *
     * @param Request $request
     * @return mixed
     */
    public function toggleCategory(Request $request)
    {
        $user = \Auth::user();
        $user->company->categories()->toggle($request->id);

        if($request->status !== true) {
            return Response::json([
                'messages' => [
                    'Услуга удалена'
                ],
                'success'  => true,
            ], 200);
        }

        return Response::json([
            'messages' => [
                'Услуга добавлена'
            ],
            'success'  => true,
        ], 200);
    }
}
