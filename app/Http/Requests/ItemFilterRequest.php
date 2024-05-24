<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemFilterRequest extends FormRequest
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
            'item_id' => ['sometimes', 'nullable', 'string', 'max:255'],
            'nama_item' => ['sometimes', 'nullable', 'string', 'max:255'],
            'category_item_id' => ['sometimes', 'nullable', 'integer', 'max:255'],
        ];
    }
}
