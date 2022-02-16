<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BranchEditRequest extends FormRequest
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
            'is_active' => 'required|boolean',
            'name' => 'required|unique:branches,name,'.$this->id.',id|max:100',
            'code' => 'sometimes|unique:branches,code,'.$this->id.',id|max:50',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'nullable',
            'postal' => 'nullable',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
            'telephone' => 'nullable',
            'mobile' => 'nullable'
        ];
    }
}
