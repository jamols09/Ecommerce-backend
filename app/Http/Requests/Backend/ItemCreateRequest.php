<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ItemCreateRequest extends FormRequest
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
        return  [
            'name' => 'required|unique:items,name|max:100',
            'branches' => 'required',
            'department_id' => 'nullable|numeric',
            'brand_id' => 'nullable|numeric',
            'is_discountable' => 'required|boolean',
            'description' => 'nullable',
            'sku' => 'nullable|unique:items,sku|alpha_num',
            'is_active' => 'required|boolean',
            'is_display_qty' => 'required|boolean',
            'quantity' => 'required|numeric',
            'quantity_warn' => 'required|numeric',
            'color' => 'nullable|alpha',
            'size' => 'nullable|alpha_num',
            'material' => 'nullable',
            'weight_unit' => 'nullable|in:GRAM,KILOGRAM',
            'weight_amount' => 'nullable|numeric',
            'dimension_unit' => 'nullable|in:INCH,CENTIMETER',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
        ];
    }
}
