<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeMaleRequest extends FormRequest
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
            "vote_male"=>"required"
        ];
    }
    public function messages(): array
    {
        return [
            'vote_male.required' => 'အမျိုးသားမဲ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
        ];
    }
}
