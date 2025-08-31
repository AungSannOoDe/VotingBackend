<?php

namespace App\Http\Requests;

use App\Models\tempo;
use App\Models\Elector;
use App\Rules\UniqueGender;
use Illuminate\Foundation\Http\FormRequest;

class StoretempoRequest extends FormRequest
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
            "elector_id"=>['required',new UniqueGender($this->voter_id,'electors','tempos')],
            "voter_id"=>"required"
        ];
    }
    public function messages(): array
    {
        return [
            'elector_id.required' => 'မဲဆန္ဒနယ် ID ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'voter_id.required' => 'မဲဆန္ဒနယ်ခွဲ ID ထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
