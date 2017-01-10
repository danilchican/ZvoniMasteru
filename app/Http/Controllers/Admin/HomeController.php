<?php

namespace App\Http\Controllers\Admin;

class HomeController extends AdminController
{
    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlePage = $this->titlePage;

        return view('admin.index')->with(compact('titlePage'));
    }
}
