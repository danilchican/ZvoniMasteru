<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $company = $user->company;

        return view('account.index')->with(compact([
            'user', 'company',
        ]));
    }

    public function getAccountInfo()
    {
        $user = \Auth::user();

        return Response::json([
            'user' => $user,
            'contacts' => $user->company->contacts()->with('groups')->get(),
            'success'  => true,
        ], 200);
    }
}
