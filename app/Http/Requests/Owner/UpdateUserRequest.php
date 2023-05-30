<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        'name' => 'required|min:3|max:20',
        'email' => 'required|email|min:3|max:25',
        'password' => 'required|min:8|max:12', 
        'isMale' => 'boolean',
        'phone' => 'min:8|max:20|nullable',
        'address' => 'min:8|max:30|nullable'
    ];
  }
  public function messages(): array
{
  return [
      'name.required' => 'The name field is required.',
      'email.required' => 'The email field is required.',
      'email.min' => "The email can't be less than 3 charecter.",
      'email.max' => "The email can't be more than 25 charecter.",
      'password.required' => 'The password field is required.',
      'password.min' => "The password can't be less than 8 charecter.",
      'password.max' => "The password can't be more than 12 charecter.",
      'phone.min' => 'The phone field must be at least :min characters.',
      'address.min' => 'The address field must be at least :min characters.',
  ];
}
}
