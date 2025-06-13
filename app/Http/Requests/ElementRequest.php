<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'element_name' => [
                'required',       // Ensure element_name is provided
                'string',         // Ensure it's a string
                'max:255',
                'unique:elements,name',
                // Limit to a maximum of 255 characters
            ],
            'is_vltd' => [
                'required',       // Ensure is_vltd is provided     
            ],
        ];
    }

}
