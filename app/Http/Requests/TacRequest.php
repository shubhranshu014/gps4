<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TacRequest extends FormRequest
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
           'element' => 'required',
            'element_type' => 'required',
            'model_no' => 'required',
            'device_part_no' => 'required',
            'tac_No' => 'required|array', // Validate tac_No as an array of values
            'tac_No.*' => 'required|string|max:255', // Validate each TAC number as a string with a max length of 255
        ];
    }
}
