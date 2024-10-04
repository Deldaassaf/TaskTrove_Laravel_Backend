<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'password' => 'required|string'
        ];
    }

    public function authorize()
    {
        return true; 
    }
}
