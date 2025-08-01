<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoterRequest extends FormRequest
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
        return
            [
                'voter_name' => 'required|string|max:255',
                'voter_email' => 'required|email|unique:voters,voter_email',
                'voter_password' => 'required|string|min:8',
                'profile_image' => 'nullable|string|max:2048'
            ];
    }
}
