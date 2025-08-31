<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTokenRequest extends FormRequest
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
                "token_name"=>'required'
        ];
    }
    public function messages(): array
    {
        return [
            'token_name.required' => 'တိုကင်အမည် ထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
