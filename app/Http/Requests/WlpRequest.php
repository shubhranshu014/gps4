<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WlpRequest extends FormRequest
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
            'country' => 'required',
            'state' => 'required',
            'name' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
           'email_id' => 'required|email|unique:wlps,email',
            'smart_parent_app_package' => 'required',
            'show_powered_by' => 'required',
            'account_limit' => 'required',
            
        ];
    }
}
