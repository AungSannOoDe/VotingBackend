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
            "image_1" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
             "image_2" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
             "image_3"=> "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
             "elector_id" => "required|exists:electors,id"
        ];
    }
}
