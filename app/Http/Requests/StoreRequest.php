<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "unique:products,name|min:3|required",
            "price" => "required|numeric|min:1",
            "category" => "required",
            "description" => "required",
            "color" => "required",
            "image" => "required|image|mimes:webp,png,jpg,jpeg",
            "in_stock" => "required|numeric",
            "seller_id" => "required",
        ];
    }
    public function messages(): array
    {
        return [
            "name.required" => "name is required",
        ];
    }
}
