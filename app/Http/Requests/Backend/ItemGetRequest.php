<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ItemGetRequest extends FormRequest
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

	protected function prepareForValidation()
	{
		$this->merge(['id' => $this->route('id')]);
	}

	/**
	 * Get item on existing branch
	 *
	 * @return array
	 */
	public function rules()
	{

		return  [
			'id' => [
				'required',
				'exists:branches,id'
			]
		];
	}
}
