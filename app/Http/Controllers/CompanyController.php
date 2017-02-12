<?php

namespace App\Http\Controllers;

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
        $phones = $company->contacts->phones()->filled()->get();
        $groups = $company->contacts->groups;

        return view('companies.cart')->with(compact(['company', 'phones', 'groups']));
    }
}
