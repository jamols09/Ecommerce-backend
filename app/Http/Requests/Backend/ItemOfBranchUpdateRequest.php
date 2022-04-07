<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ItemOfBranchUpdateRequest extends FormRequest
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
            'is_active' => 'sometimes|numeric',
            'is_display_qty' => 'sometimes|numeric',
            'quantity' => 'sometimes|numeric',
            'quantity_warn' => 'sometimes|numeric',
            'price' => 'sometimes|numeric'
        ];
    }
}
