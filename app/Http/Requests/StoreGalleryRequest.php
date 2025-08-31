<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            "images"=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",

        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'ခေါင်းစဉ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'title.string' => 'ခေါင်းစဉ်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'title.max' => 'ခေါင်းစဉ်သည် အက္ခရာ ၂၅၅ လုံးထက် မပိုရပါ။',
        
            'description.string' => 'ဖော်ပြချက်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'description.max' => 'ဖော်ပြချက်သည် အက္ခရာ ၁၀၀၀ လုံးထက် မပိုရပါ။',
        
            'images.required' => 'ဓာတ်ပုံ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'images.image' => 'ဓာတ်ပုံဖိုင်သာ ဖြစ်ရပါမည်။',
            'images.mimes' => 'ဓာတ်ပုံ ၏ ဖိုင်အမျိုးအစားသည် jpeg, png, jpg, gif, svg သာ ဖြစ်ရပါမည်။',
            'images.max' => 'ဓာတ်ပုံ ၏ အရွယ်အစားသည် ၂၀၄၈ KB (၂ MB) ထက် မကျော်ရပါ။'
        ];
    }
}
