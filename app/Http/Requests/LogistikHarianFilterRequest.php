<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogistikHarianFilterRequest extends FormRequest
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
            'status_logistik_id' => ['sometimes', 'nullable', 'integer'],
            'order_id' => ['sometimes', 'nullable', 'integer'],
            'item_id' => ['sometimes', 'nullable', 'string', 'max:255'],
            'customer_id' => ['sometimes', 'nullable', 'integer'],
            'nama_item' => ['sometimes', 'nullable', 'string', 'max:255'],
            'nama_customer' => ['sometimes', 'nullable', 'string', 'max:255'],
            'tanggal_transaksi' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
