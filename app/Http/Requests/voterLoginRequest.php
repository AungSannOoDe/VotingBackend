<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class voterLoginRequest extends FormRequest
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
            "voter_email"=>'required',
            "voter_password"=>'required'
        ];
    }
    public function messages(): array
    {
        return [
            'voter_email.required' => 'မဲပေးသူအီးမေးလ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'voter_password.required' => 'မဲပေးသူစကားဝှက် ထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
