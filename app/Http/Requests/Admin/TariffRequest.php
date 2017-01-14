<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TariffRequest extends FormRequest
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
            'title' => 'required|min:3|max:80',
            'whom' => 'required',
            'top' => 'required|integer',
            'prices' => 'required|array',
            'prices.*' => 'required|numeric',
            'services' => 'required|array',
            'services.*' => 'integer|exists:tariff_services,id',
            'ranges' => 'required|array'
        ];
    }
}
