<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\UpdatePhoneRequest;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class PhoneController extends Controller
{
    /**
     * Get all company phones.
     *
     * @return mixed
     */
    public function getPhones()
    {
        return Response::json([
            'phones' => \Auth::user()->company->contacts->phones()->get(),
            'success'  => true,
        ], 200);
    }

    /**
     * Create new phone of the company.
     *
     * @param UpdatePhoneRequest $request
     * @return mixed
     */
    public function createPhone(UpdatePhoneRequest $request)
    {
        $contacts = \Auth::user()->company->contacts;

        if($contacts->phones()->count() + 1 > 3) {
            return Response::json([
                'Вы можете иметь не более 3-х номеров.'
            ], 419);
        }

        $phone = $contacts->phones()->create(
            $request->only(['number'])
        );

        return Response::json([
            'messages' => [
                'Телефон добавлен.'
            ],
            'success'  => true,
        ], 200);
    }
}
