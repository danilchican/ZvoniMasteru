<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'website_url' => 'min:3|max:50|url',
            'address' => 'min:3|max:80',
            'email' => 'email',
            'skype' => 'min:3|max:20',
            'viber' => 'phone:AUTO',
            'icq' => 'min:3|max:20'
        ];
    }
}
