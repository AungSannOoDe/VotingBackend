<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
             'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'အီးမေးလ် လိပ်စာ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'email.email' => 'အီးမေးလ် လိပ်စာ ပုံစံ မှန်ကန်ရပါမည်။',
            'password.required' => 'စကားဝှက် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'password.string' => 'စကားဝှက်သည် စာသား ပုံစံ ဖြစ်ရပါမည်။',
        ];
    }
}
