<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMainSettingsRequest extends FormRequest
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
            'username' => 'min:2|max:30|required',
            'name' => 'min:2|max:30|required',
            'slug' => 'min:5|max:30|alpha_dash|required',
            'unp_number' => 'required|size:9|regex:/[0-9]{9}/',
            'description' => 'required|min:3|max:300'
        ];
    }
}
