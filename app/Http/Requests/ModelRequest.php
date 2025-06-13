<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelRequest extends FormRequest
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
            'element' => 'required|numeric',
            'element_type' => 'required|numeric',
            'model_no' => 'required|string|max:255',  // Ensure model_no is a string with a maximum length of 255 characters
            'voltage' => 'required|numeric',
        ];
    }
}
