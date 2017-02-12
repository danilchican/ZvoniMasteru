<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends HomeController
{
    /**
     * Get the current category page with companies.
     *
     * @param $category
     * @return $this
     * @throws \Exception
     */
    public function show($category)
    {
        $cat = Category::withDepth()->where('slug', '=', $category)->first();

        if(is_null($cat)) {
            throw new \Exception();
        }

        $categories = $cat->children;

        if($categories->isEmpty()) {
            $depth = $cat->depth - 1;
            $category = $cat->ancestors()->withDepth()->having('depth', '=', $depth)->first();

            if($category !== null) {
                $categories = $category->children;
            }
        }

        return view('categories.show')->with([
            'categories' => $categories,
            'companies' => $cat->companies()->published()->paginate(5),
        ]);
    }
}
