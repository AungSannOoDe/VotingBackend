<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateElectorRequest extends FormRequest
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
            "elector_name"=>'required',
            "phone"=>'required',
            "address"=>"required",
            "gender"=>"required",
            "Years"=>'required',
            "won_status"=>'required'
        ];
    }
    public function messages(): array
    {
        return [
            'elector_name.required' => 'မဲဆန္ဒနယ်နာမည် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'phone.required' => 'ဖုန်းနံပါတ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'address.required' => 'လိပ်စာ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'gender.required' => 'လိင် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'Years.required' => 'နှစ်ကာလ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'won_status.required' => 'အနိုင်ရ status ထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
