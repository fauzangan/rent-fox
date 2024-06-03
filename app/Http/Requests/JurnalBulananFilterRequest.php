<?php

namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class JurnalBulananFilterRequest extends FormRequest
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
            'bulan_tahun' => [
                'sometimes',
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Pisahkan bulan dan tahun
                    $parts = explode(' ', $value);
    
                    // Validasi format
                    if (count($parts) !== 2) {
                        return $fail('Format bulan dan tahun tidak valid.');
                    }
    
                    // Validasi nama bulan
                    $bulan = strtolower($parts[0]);
                    $validMonths = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];
                    if (!in_array($bulan, $validMonths)) {
                        return $fail('Bulan tidak valid.');
                    }
    
                    // Validasi tahun (harus berupa angka)
                    $tahun = $parts[1];
                    if (!is_numeric($tahun)) {
                        return $fail('Tahun tidak valid.');
                    }
                },
            ],
            'date_range' => ['sometimes', 'required', 'string' , function ($attribute, $value, $fail) {
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
