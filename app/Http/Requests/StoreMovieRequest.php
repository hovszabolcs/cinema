<?php

namespace App\Http\Requests;

use App\Enums\AgeClassification;
use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('patch'))
            return [
                'title' => 'sometimes|required|string|max:120',
                'description' => 'sometimes|required',
                'age_classification' => 'sometimes|required|integer|in:' . join(',', AgeClassification::toArray()),
                'lang' => 'sometimes|required|string|max:20',
                'image_path' => 'sometimes|required|url:http,https|max:255'
            ];
        else
            return [
                'title' => 'required|string|max:120',
                'description' => 'required',
                'age_classification' => 'required|integer|in:' . join(',', AgeClassification::toArray()),
                'lang' => 'required|string|max:20',
                'image_path' => 'required|url:http,https|max:255'
            ];
    }
}
