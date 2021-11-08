<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BrandCreateRequest extends FormRequest
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
     * Create brand name that is unique.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:brands,name|max:50',
        ];
    }
}
