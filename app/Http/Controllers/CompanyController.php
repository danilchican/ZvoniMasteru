<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends HomeController
{

    /**
     * View cart of the company.
     *
     * @param $slug
     * @return $this|\Illuminate\Http\Response
     */
    public function cart($slug)
    {
        $company = Company::where('slug', '=', $slug)->first();

        if(!$company) {
            return view('errors.503');
        }

        $categories = Category::withDepth()->having('depth', '=', 0)->get()->toTree();

        $phones = $company->contacts->phones()->filled()->get();
        $groups = $company->contacts->groups;
        $reviews = $company->reviews()->get();

        return view('companies.cart')->with(compact([
            'company', 'phones', 'groups', 'reviews', 'categories'
        ]));
    }
}
