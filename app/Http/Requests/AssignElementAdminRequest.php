<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignElementAdminRequest extends FormRequest
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
        $rules = [
            'element' => ['required', 'array'],
        ];
    
        if (auth()->guard()->getName() === 'admin') {
            $rules['element.*'] = [
                'integer',
                'distinct',
                Rule::unique('assign_element_admins', 'element_id')
            ];
            $rules['wlp'] = ['required', 'integer'];
        } else {
            $rules['element.*'] = ['integer', 'distinct'];
            $rules['admin'] = ['required', 'integer'];
        }
    
        return $rules;
    }
    

}
