<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
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
            'id'=>"required",
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
    public function messages(): array
    {
        return [
            'id.required' => 'ID ထည့်သွင်းရန် လိုအပ်ပါသည်။',
        
            'title.required' => 'ခေါင်းစဉ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'title.string' => 'ခေါင်းစဉ်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'title.max' => 'ခေါင်းစဉ်သည် အက္ခရာ ၂၅၅ လုံးထက် မပိုရပါ။',
        
            'description.required' => 'ဖော်ပြချက် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'description.string' => 'ဖော်ပြချက်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'description.max' => 'ဖော်ပြချက်သည် အက္ခရာ ၁၀၀၀ လုံးထက် မပိုရပါ။',
        
            'images.image' => 'ဓာတ်ပုံသည် ဓာတ်ပုံဖိုင်သာ ဖြစ်ရပါမည်။',
            'images.mimes' => 'ဓာတ်ပုံ ၏ ဖိုင်အမျိုးအစားသည် jpeg, png, jpg, gif, svg သာ ဖြစ်ရပါမည်။',
            'images.max' => 'ဓာတ်ပုံ ၏ အရွယ်အစားသည် ၂၀၄၈ KB (၂ MB) ထက် မကျော်ရပါ။'
        ];
    }
}
