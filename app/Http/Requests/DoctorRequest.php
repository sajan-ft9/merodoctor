<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
        return [
            'name'  => "required|string|max:50",
            'email'  => "required|email|unique:users,email",
            'department'  => "required|string|max:50",
            'license_no'  => "required|string|max:50",
            'image_path' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
        ];
    }
}
