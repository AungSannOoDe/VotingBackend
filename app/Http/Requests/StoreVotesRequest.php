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
            'vote_code' => 'nullable|string|max:255',
            'archived_at' => 'nullable|integer', // Assuming archived_at is an integer timestamp
        ];
    }
}
