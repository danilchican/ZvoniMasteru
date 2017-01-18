<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name'      => 'required|min:3|max:80',
            'slug'      => 'required|min:3|max:80|alpha_dash',
            'desc'      => '',
            'parent'    => 'integer|exists:categories,id',
            'thumbnail' => 'image|max:5000',
        ];
    }
}
