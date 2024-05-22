<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'author.name' => 'required|string|max:255|min:4',
            'author.job' => 'required|string|max:255|min:4',
        ];
    }


    public function messages(): array
    {
        return [
            'author.name.required' => 'The name field is required.',
            'author.name.string' => 'The name must be a string.',
            'author.name.max' => 'The name must not exceed 255 characters.',
            'author.name.min' => 'The name must be at least 5 characters long.',
            'author.job.required' => 'The job field is required.',
            'author.job.string' => 'The job must be a string.',
            'author.job.max' => 'The job must not exceed 255 characters.',
            'author.job.min' => 'The job must be at least 5 characters long.',
        ];
    }
}