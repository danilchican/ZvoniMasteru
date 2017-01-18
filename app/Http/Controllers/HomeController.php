<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withDepth()->having('depth', '=', 0)->get()->toTree();

        return view('welcome')->with(compact(['categories']));
    }
}
