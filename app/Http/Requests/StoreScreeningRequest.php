<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScreeningRequest extends FormRequest
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
        if ($this->isMethod('patch')) {
            return [
                'start' => 'sometimes|required|string|max:120',
                'seats_available' => 'sometimes|required|integer|max:127|min:0',
                'url' => 'sometimes|required|string|max:255',
                'movie_id' => 'sometimes|required|exists:movies,id'
            ];
        }

        return [
            'start' => 'required|string|max:120',
            'seats_available' => 'required|integer|max:127|min:0',
            'url' => 'required|string|max:255',
            'movie_id' => 'required|exists:movies,id'
        ];
    }
}
