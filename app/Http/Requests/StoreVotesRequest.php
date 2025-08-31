<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVotesRequest extends FormRequest
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
            'voter_id' => 'required|integer|exists:voters,id',
            'elector_id' => 'required|integer|exists:electors,id',
            'vote_code' => 'required|string|max:255',
            'archived_at' => 'required|integer',
        ];
    }
    public function messages(): array
    {
        return [
            'voter_id.required' => 'မဲပေးသူ ID ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'voter_id.integer' => 'မဲပေးသူ ID သည် ကိန်းပြည့် ဖြစ်ရပါမည်။',
            'voter_id.exists' => 'ရွေးချယ်ထားသော မဲပေးသူ ID မှားယွင်းနေပါသည်။',
        
            'elector_id.required' => 'မဲဆန္ဒနယ် ID ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'elector_id.integer' => 'မဲဆန္ဒနယ် ID သည် ကိန်းပြည့် ဖြစ်ရပါမည်။',
            'elector_id.exists' => 'ရွေးချယ်ထားသော မဲဆန္ဒနယ် ID မှားယွင်းနေပါသည်။',
        
            'vote_code.required' => 'မဲကုဒ် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'vote_code.string' => 'မဲကုဒ်သည် စာသားပုံစံ ဖြစ်ရပါမည်။',
            'vote_code.max' => 'မဲကုဒ်သည် အက္ခရာ ၂၅၅ လုံးထက် မပိုရပါ။',
        
            'archived_at.required' => 'မော်ကွန်းတင်သည့်အချိန် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'archived_at.integer' => 'မော်ကွန်းတင်သည့်အချိန်သည် ကိန်းပြည့် ဖြစ်ရပါမည်။'
        ];
    }
}
