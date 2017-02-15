<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
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
            'author' => 'min:3|max:60|required',
            'email' => 'min:3|max:60|email|required',
            'advantages' => 'min:15|max:400|required',
            'disadvantages' => 'min:15|max:400|required',
            'phone' => 'phone:AUTO|required'
        ];
    }
}
