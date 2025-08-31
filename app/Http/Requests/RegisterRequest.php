<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
             'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'နာမည် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'name.string' => 'နာမည်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'name.max' => 'နာမည်သည် အက္ခရာ ၂၅၅ လုံးထက် မပိုရပါ။',
        
            'email.required' => 'အီးမေးလ် လိပ်စာ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'email.string' => 'အီးမေးလ်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'email.email' => 'အီးမေးလ် လိပ်စာ ပုံစံ မှန်ကန်ရပါမည်။',
            'email.max' => 'အီးမေးလ်သည် အက္ခရာ ၂၅၅ လုံးထက် မပိုရပါ။',
            'email.unique' => 'ဤအီးမေးလ်လိပ်စာဖြင့် အသုံးပြုသူရှိပြီးဖြစ်သည်။',
        
            'password.required' => 'စကားဝှက် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'password.string' => 'စကားဝှက်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'password.min' => 'စကားဝှက်တွင် အနည်းဆုံး ၈ လုံး ရှိရပါမည်။',
            'password.confirmed' => 'စကားဝှက် အတည်ပြုချက် ကိုက်ညီမှုမရှိပါ။',
        ];
    }
}
