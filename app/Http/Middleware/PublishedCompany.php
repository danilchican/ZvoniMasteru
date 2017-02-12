<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;

class PublishedCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $company = Company::find($request->id);

        if($company !== null) {
            if($company->isPublished()) {
                return $next($request);
            }
        }

        return redirect()->back();
    }
}
