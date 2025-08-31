<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAblumRequest extends FormRequest
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
            "elector_id" => "required|exists:electors,id",
             "image_1" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
             "image_2" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
             "image_3"=> "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
             "image_4"=> "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ];
    }
    public function messages(): array
    {
        return [
            'elector_id.required' => 'မဲဆန္ဒနယ် ID ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'elector_id.exists' => 'ရွေးချယ်ထားသော မဲဆန္ဒနယ် ID မှားယွင်းနေပါသည်။',
        
            'image_1.required' => 'ဓာတ်ပုံ (၁) ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'image_1.image' => 'ဓာတ်ပုံ (၁) သည် ဓာတ်ပုံဖိုင်သာ ဖြစ်ရပါမည်။',
            'image_1.mimes' => 'ဓာတ်ပုံ (၁) ၏ ဖိုင်အမျိုးအစားသည် jpeg, png, jpg, gif, svg သာ ဖြစ်ရပါမည်။',
            'image_1.max' => 'ဓာတ်ပုံ (၁) ၏ အရွယ်အစားသည် ၂၀၄၈ KB (၂ MB) ထက် မကျော်ရပါ။',
        
            'image_2.required' => 'ဓာတ်ပုံ (၂) ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'image_2.image' => 'ဓာတ်ပုံ (၂) သည် ဓာတ်ပုံဖိုင်သာ ဖြစ်ရပါမည်။',
            'image_2.mimes' => 'ဓာတ်ပုံ (၂) ၏ ဖိုင်အမျိုးအစားသည် jpeg, png, jpg, gif, svg သာ ဖြစ်ရပါမည်။',
            'image_2.max' => 'ဓာတ်ပုံ (၂) ၏ အရွယ်အစားသည် ၂၀၄၈ KB (၂ MB) ထက် မကျော်ရပါ။',
        
            'image_3.required' => 'ဓာတ်ပုံ (၃) ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'image_3.image' => 'ဓာတ်ပုံ (၃) သည် ဓာတ်ပုံဖိုင်သာ ဖြစ်ရပါမည်။',
            'image_3.mimes' => 'ဓာတ်ပုံ (၃) ၏ ဖိုင်အမျိုးအစားသည် jpeg, png, jpg, gif, svg သာ ဖြစ်ရပါမည်။',
            'image_3.max' => 'ဓာတ်ပုံ (၃) ၏ အရွယ်အစားသည် ၂၀၄၈ KB (၂ MB) ထက် မကျော်ရပါ။',
        
            'image_4.required' => 'ဓာတ်ပုံ (၄) ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'image_4.image' => 'ဓာတ်ပုံ (၄) သည် ဓာတ်ပုံဖိုင်သာ ဖြစ်ရပါမည်။',
            'image_4.mimes' => 'ဓာတ်ပုံ (၄) ၏ ဖိုင်အမျိုးအစားသည် jpeg, png, jpg, gif, svg သာ ဖြစ်ရပါမည်။',
            'image_4.max' => 'ဓာတ်ပုံ (၄) ၏ အရွယ်အစားသည် ၂၀၄၈ KB (၂ MB) ထက် မကျော်ရပါ။'
        ];
    }
}
