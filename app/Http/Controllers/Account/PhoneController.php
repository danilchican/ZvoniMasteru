<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\UpdatePhoneRequest;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * Create new phone number of the company.
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

    /**
     * Update phone number of the company.
     *
     * @param UpdatePhoneRequest $request
     * @return mixed
     */
    public function updatePhone(UpdatePhoneRequest $request)
    {
        try {
            $phone = Phone::find($request->input('id'));
            $phone->update($request->only(['number']));

            return Response::json([
                'messages' => [
                    'Номер телефона обновлён.'
                ],
                'success'  => true,
            ], 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json([
                'Такого телефона не существует. Обновите страницу.'
            ], 419);
        }
    }

    public function deletePhone(Request $request, $id = null) {
        try {
            $phone = Phone::find($id);
            $phone->delete();

            return Response::json([
                'messages' => [
                    'Номер телефона удалён.'
                ],
                'success'  => true,
            ], 200);
        } catch (ModelNotFoundException $ex) {
            return Response::json([
                'Такого телефона не существует. Обновите страницу.'
            ], 419);
        }
    }
}
