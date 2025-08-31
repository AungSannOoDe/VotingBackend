<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeImageRequest extends FormRequest
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
            'image'=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }
    public function messages(): array
    {
        return [
            'image.required' => 'ဓာတ်ပုံ ဖိုင်ကို ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'image.image' => 'ဓာတ်ပုံ ဖိုင်သာ ဖြစ်ရပါမည်။',
            'image.mimes' => 'ဖိုင်အမျိုးအစား: jpeg, png, jpg, gif, svg သာ ဖြစ်ရပါမည်။',
            'image.max' => 'ဖိုင်အရွယ်အစား ၂၀၄၈ KB (၂ MB) ထက် မကျော်ရပါ။'
        ];
    }
}
