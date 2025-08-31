<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokenRegister extends FormRequest
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
            "voter_name"=>'required|string|max:25',
            "voter_email"=>'required|email|max:255|unique:voters,voter_email',
            "voter_password"=>'required|string|min:6'
        ];
    }
    public function messages(): array
    {
        return [
            'voter_name.required' => 'မဲပေးသူအမည် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'voter_name.string' => 'မဲပေးသူအမည်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'voter_name.max' => 'မဲပေးသူအမည်သည် အက္ခရာ ၂၅ လုံးထက် မပိုရပါ။',
        
            'voter_email.required' => 'မဲပေးသူအီးမေးလ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'voter_email.email' => 'မဲပေးသူအီးမေးလ် ပုံစံ မှန်ကန်ရပါမည်။',
            'voter_email.max' => 'မဲပေးသူအီးမေးလ်သည် အက္ခရာ ၂၅၅ လုံးထက် မပိုရပါ။',
            'voter_email.unique' => 'ဤအီးမေးလ်လိပ်စာဖြင့် မဲပေးသူရှိပြီးဖြစ်သည်။',
        
            'voter_password.required' => 'မဲပေးသူစကားဝှက် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'voter_password.string' => 'မဲပေးသူစကားဝှက်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'voter_password.min' => 'မဲပေးသူစကားဝှက်တွင် အနည်းဆုံး ၆ လုံး ရှိရပါမည်။'
        ];
    }
}
