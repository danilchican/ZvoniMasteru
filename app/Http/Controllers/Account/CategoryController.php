<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\SyncCategoriesRequest;
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
     * Attach categories for a company.
     *
     * @param SyncCategoriesRequest $request
     * @return mixed
     */
    public function attachCategories(SyncCategoriesRequest $request)
    {
        $user = \Auth::user();
        $user->company->categories()->sync($request->ids);

        return Response::json([
            'messages' => [
                'Услуги обновлены'
            ],
            'success'  => true,
        ], 200);
    }
}
