<?php

namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class OrderFilterRequest extends FormRequest
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
            'nama' => ['sometimes', 'nullable', 'string', 'max:255'],
            'perusahaan' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status_transport_id' => ['sometimes', 'nullable', 'integer'],
            'status_order_id' => ['sometimes', 'nullable', 'integer'],
            'tanggal_order' => ['sometimes', 'nullable', 'string' , function ($attribute, $value, $fail) {
                if ($value) {
                    $dates = explode(' - ', $value);
                    if (count($dates) !== 2) {
                        return $fail('Format tanggal tidak valid.');
                    }
                    foreach ($dates as $date) {
                        $d = DateTime::createFromFormat('d/m/Y', $date);
                        if (!$d || $d->format('d/m/Y') !== $date) {
                            return $fail('Tanggal tidak valid.');
                        }
                    }
                }
            }],
            'tanggal_kirim' => ['sometimes', 'nullable', 'string', function ($attribute, $value, $fail) {
                if ($value) {
                    $dates = explode(' - ', $value);
                    if (count($dates) !== 2) {
                        return $fail('Format tanggal tidak valid.');
                    }
                    foreach ($dates as $date) {
                        $d = DateTime::createFromFormat('d/m/Y', $date);
                        if (!$d || $d->format('d/m/Y') !== $date) {
                            return $fail('Tanggal tidak valid.');
                        }
                    }
                }
            }],
        ];
    }
}
