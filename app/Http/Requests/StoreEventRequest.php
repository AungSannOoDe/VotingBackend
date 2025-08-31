<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
       "event_name"=>"required",
       "event_participant"=>"required",
       "event_start_time"=>"required"
        ];
    }
    public function messages(): array
    {
        return [
            'event_name.required' => 'ပွဲအမည် ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'event_participant.required' => 'ပွဲတက်ရောက်မည့်သူ ထည့်သွင်းရန် လိုအပ်ပါသည်။',
            'event_start_time.required' => 'ပွဲစတင်ချိန် ထည့်သွင်းရန် လိုအပ်ပါသည်။'
        ];
    }
}
