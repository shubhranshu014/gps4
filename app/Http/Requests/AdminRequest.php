<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name_of_the_business' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:255',
            'regd_address' => 'required|max:255',
            'gstin_no' => 'required | regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{1}Z[A-Z0-9]{1}$/',
            'pan_no' => 'required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            'name_of_the_business_owner' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'contact_no' => 'required | regex:/^[6-9]\d{9}$/ | unique:admins,contact_no',
            'company_logo' => 'required | file | mimes:jpg,jpeg,png',
        ];
    }
}
