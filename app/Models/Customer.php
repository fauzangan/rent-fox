<?php

namespace App\Models;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'customer_id';

    protected $guarded = [
        'customer_id'
    ];

    protected $casts = [
        'identitas_berlaku' => 'datetime'
    ];

    public static function createCustomer($data)
    {
        return DB::transaction(function () use ($data) {
            // Jika is_perusahaan benar, buat Perusahaan
            if ($data['is_perusahaan'] != "0") {
                $perusahaan = Perusahaan::create([
                    'badan_hukum' => $data['badan_hukum'],
                    'nama' => $data['nama_perusahaan'],
                    'alamat' => $data['alamat_perusahaan'],
                    'kota' => $data['kota_perusahaan'],
                    'provinsi' => $data['provinsi_perusahaan'],
                    'telp' => $data['telp_perusahaan'],
                    'fax' => $data['fax_perusahaan'],
                ]);
                $data['perusahaan_id'] = $perusahaan->perusahaan_id;
            }  else {
                $data['perusahaan_id'] = null;
            }
            
            // Handle identitas_berlaku berdasarkan jenis identitas
            if ($data['jenis_identitas'] == 'KTP') {
                $data['identitas_berlaku'] = null;
            } else {
                $data['identitas_berlaku'] = DateTime::createFromFormat('d/m/Y', $data['identitas_berlaku'])->format('Y-m-d');
            }
            
            // Buat Customer
            return Customer::create([
                'nama' => $data['nama'],
                'jenis_identitas' => $data['jenis_identitas'],
                'identitas_berlaku' => $data['identitas_berlaku'],
                'nomor_identitas' => $data['nomor_identitas'],
                'jabatan' => $data['jabatan'],
                'alamat' => $data['alamat'],
                'kota' => $data['kota'],
                'provinsi' => $data['provinsi'],
                'telp' => $data['telp'],
                'fax' => $data['fax'],
                'handphone' => $data['handphone'],
                'perusahaan_id' => $data['perusahaan_id'],
                'keterangan' => $data['keterangan'],
                'bonafidity' => $data['bonafidity'],
                'bit_active' => $data['bit_active']
            ]);
            // return self::create($data);
        });
    }

    public function updateCustomer($data)
    {
        return DB::transaction(function () use ($data) {
            // Jika customer memiliki perusahaan_id, update Perusahaan
            if ($this->perusahaan_id != null) {
                Perusahaan::where('perusahaan_id', $this->perusahaan_id)->update([
                    'badan_hukum' => $data['badan_hukum'],
                    'nama' => $data['nama_perusahaan'],
                    'alamat' => $data['alamat_perusahaan'],
                    'kota' => $data['kota_perusahaan'],
                    'provinsi' => $data['provinsi_perusahaan'],
                    'telp' => $data['telp_perusahaan'],
                    'fax' => $data['fax_perusahaan'],
                ]);
            }

            // Tangani identitas_berlaku berdasarkan jenis identitas
            if ($data['jenis_identitas'] == "KTP") {
                $data['identitas_berlaku'] = null;
            } else {
                $data['identitas_berlaku'] = DateTime::createFromFormat('d/m/Y', $data['identitas_berlaku'])->format('Y-m-d');
            }

            // Perbarui data customer
            return $this->update($data);
        });
    }
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
}
