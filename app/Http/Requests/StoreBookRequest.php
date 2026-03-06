<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:books,isbn',
            'category_id' => 'nullable|exists:categories,id',
            'author_id' => 'nullable|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,webp|max:2048', // Max 2MB
            'description' => 'nullable|string',
            'status' => ['required', 'string', Rule::in(['Available', 'Borrowed', 'Reserved'])],
            'active' => 'sometimes|boolean',
            'published_at' => 'nullable|date',
        ];
    }
}
