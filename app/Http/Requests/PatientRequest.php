<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name'  => "required|string|max:50",
            'email'  => "required|email|unique:users,email",
            'password'  => "required|min:8|max:25|confirmed",
            'address'  => "required|string|max:100",
            'phone'  => "required|numeric|min:9000000000|max:9999999999",
            'image_path' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
        ];
        
        return $rules;
    }
}
