<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Models\Company;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Create new review for a company.
     *
     * @param CreateReviewRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(CreateReviewRequest $request)
    {
        $company = Company::findOrFail($request->input('company-id'));
        $review = new Review($request->except('company-id'));
        $company->reviews()->save($review);

        if(!$company) {
            return response()->view('errors.'.'503');
        }

        return redirect()->back()->with([
            'message' => 'Отзыв будет опубликован после модерации.'
        ]);
    }
}
