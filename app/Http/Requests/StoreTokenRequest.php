<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTokenRequest extends FormRequest
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
            'type' => 'sometimes|in:AOY,POT,OPYT,YPY,CPC,UgtOY',
            'algorithm' => 'sometimes|in:sha256,sha512,ripemd160,whirlpool',
            "archived_at"=>'required'
        ];
    }
    public function messages(): array
    {
        return [
            'type.sometimes' => 'အမျိုးအစား ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'type.in' => 'အမျိုးအစားသည် AOY, POT, OPYT, YPY, CPC, UgtOY ထဲမှ တစ်ခုခု ဖြစ်ရပါမည်။',
        
            'algorithm.sometimes' => 'Algorithm ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'algorithm.in' => 'Algorithm သည် sha256, sha512, ripemd160, whirlpool ထဲမှ တစ်ခုခု ဖြစ်ရပါမည်။',
        
            'archived_at.required' => 'မော်ကွန်းတင်သည့်ရက်စွဲ ထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
