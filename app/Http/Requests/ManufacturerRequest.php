<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManufacturerRequest extends FormRequest
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
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'manufacturer_code' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'gst_number' => 'required|string|size:15', // Assuming GST number has a fixed length
            'parent_name' => 'nullable|integer',  // If it's allowed to be empty
            'manufacturer_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|regex:/^[\d\+\-\(\)\s]*$/|min:10|max:15', // Mobile number validation
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'logo' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // Only image files and max size limit (2MB)
        ];
    }
}
