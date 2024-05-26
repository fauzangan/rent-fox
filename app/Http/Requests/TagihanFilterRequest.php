<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagihanFilterRequest extends FormRequest
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
            'tagihan_id' => ['sometimes', 'nullable', 'integer'],
            'order_id' => ['sometimes', 'nullable', 'integer'],
            'customer_id' => ['sometimes', 'nullable', 'integer'],
            'nama_customer' => ['sometimes', 'nullable', 'string'],
            'nama_perusahaan' => ['sometimes', 'nullable', 'string'],
            'jenis_tagihan_id' => ['sometimes', 'nullable', 'integer'],
            'status_tagihan_id' => ['sometimes', 'nullable', 'integer'],
            'tanggal_ditagihkan' => ['sometimes', 'nullable', 'string'],
            'jatuh_tempo_1' => ['sometimes', 'nullable', 'string'],
            'jatuh_tempo_2' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
