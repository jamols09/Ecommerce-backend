<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UserCreateRequest extends FormRequest
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
        $rules = [];
        switch($this->has('api_bypass')) {
            // Api validation
            case 'true':
            {
                $rules = 
                ['username' => 'required|unique:users,username|max:35|alpha_dash',
                'first_name' => 'required|max:255',
                'middle_name' => 'nullable|max:255',
                'last_name' => 'nullable|max:255',
                'thumbnail' => 'nullable',
                'birthdate' => 'nullabl|before:today',
                'is_active' => 'nullable|boolean',
                'email' => 'required|unique:users,email',
                'password' => 'required|confirmed',
                'account_type' => "nullable|in:ADMIN,CLIENT"];
            }
            default: 
            // Admin validation
                $rules = 
                ['username' => 'required|unique:users,username|max:35|alpha_dash',
                'first_name' => 'required|max:255',
                'middle_name' => 'nullable|max:255',
                'last_name' => 'nullable|max:255',
                'thumbnail' => 'nullable',
                'birthdate' => 'required|before:today',
                'is_active' => 'nullable|boolean',
                'email' => 'required|unique:users,email',
                'password' => 'required|confirmed',
                'account_type' => "nullable|in:ADMIN,CLIENT"];
            break;
        }
       

        return $rules;
    }
}
