<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuHarianFilterRequest extends FormRequest
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
            'order_id' => ['sometimes', 'nullable', 'integer'],
            'customer_id' => ['sometimes', 'nullable', 'integer'],
            'tanggal_transaksi' => ['sometimes', 'nullable', 'string'],
            'group_biaya_id' => ['sometimes', 'nullable', 'integer', 'max:6'],
            'posting_biaya_id' => ['sometimes', 'nullable', 'string', 'max:6'],
        ];
    }
}
