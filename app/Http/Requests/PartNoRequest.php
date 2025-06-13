<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartNoRequest extends FormRequest
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
            "element" => "required",
            "element_type" => "required",
            "model_no" => "required",
            "device_part_no" => "required",
        ];
    }
}
