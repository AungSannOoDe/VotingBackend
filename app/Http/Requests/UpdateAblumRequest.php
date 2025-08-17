<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAblumRequest extends FormRequest
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
            "image_1" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "image_2" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "image_3" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "image_4" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ];
    }
}
