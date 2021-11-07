<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

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
			'department_id' => 'nullable|numeric',
			'brand_id' => 'nullable|numeric',
            'is_discountable' => 'required|boolean',
            'name' => 'required|unique:items,name|max:100',
            'description' => 'nullable',
			'sku' => 'nullable|alpha_num',
			'is_active' => 'required|boolean',
			'is_display_qty' => 'required|boolean',
			'quantity' => 'required|numeric',
			'quantity_warn' => 'required|numeric',
			'color' => 'nullable|alpha',
			'size' => 'nullable|alpha_num',
			'material' => 'nullable',
			'weight_unit' => 'nullable|in:Gram,Kilogram',
			'weight_amount' => 'nullable|numeric',
			'dimension_unit' => 'nullable|in:Inch,Centimeter',
			'length' => 'nullable|numeric',
			'width' => 'nullable|numeric',
			'height' => 'nullable|numeric',
        ];
    }
}
