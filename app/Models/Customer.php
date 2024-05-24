<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Builder;
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
        'identitas_berlaku' => 'date'
    ];

    public static function createCustomer($data)
    {
        return DB::transaction(function () use ($data) {
            // Handle identitas_berlaku berdasarkan jenis identitas
            if ($data['jenis_identitas'] == 'KTP') {
                $data['identitas_berlaku'] = null;
            } else {
                $data['identitas_berlaku'] = DateTime::createFromFormat('d/m/Y', $data['identitas_berlaku'])->format('Y-m-d');
            }

            $customer = Customer::create([
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
                'keterangan' => $data['keterangan'],
                'bonafidity' => $data['bonafidity'],
                'status_customer_id' => $data['status_customer_id']
            ]);

            if ($data['is_perusahaan'] != "0") {
                Perusahaan::create([
                    'badan_hukum' => $data['badan_hukum'],
                    'customer_id' => $customer->customer_id,
                    'nama' => $data['nama_perusahaan'],
                    'alamat' => $data['alamat_perusahaan'],
                    'kota' => $data['kota_perusahaan'],
                    'provinsi' => $data['provinsi_perusahaan'],
                    'telp' => $data['telp_perusahaan'],
                    'fax' => $data['fax_perusahaan'],
                ]);
            }

            // Buat Customer
            return $customer;
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

    public function scopeFilterByCustomerId(Builder $query, $customerId)
    {
        if ($customerId) {
            $query->where('customer_id', 'like', '%' . $customerId . '%');
        }
    }

    public function scopeFilterByName(Builder $query, $nama)
    {
        if ($nama) {
            $query->where('nama', 'like', '%' . $nama . '%');
        }
    }

    public function scopeFilterByNomorIdentitas(Builder $query, $nomorIdentitas)
    {
        if ($nomorIdentitas) {
            $query->where('nomor_identitas', 'like', '%' . $nomorIdentitas . '%');
        }
    }

    public function scopeFilterByHandphone(Builder $query, $handphone)
    {
        if ($handphone) {
            $query->where('handphone', 'like', '%' . $handphone . '%');
        }
    }

    public function scopeFilterByPerusahaan(Builder $query, $perusahaan)
    {
        if ($perusahaan){
            $query->whereHas('perusahaan', function ($q) use ($perusahaan){
                $q->where('nama', 'like', '%'.$perusahaan.'%');
            });
        }
    }

    public function scopeFilterByBonafidity(Builder $query, $bonafidity)
    {
        if ($bonafidity) {
            $query->where('bonafidity', '=', $bonafidity);
        }
    }

    public function scopeFilterByStatusCustomer(Builder $query, $statusCustomerId)
    {
        if ($statusCustomerId) {
            $query->where('status_customer_id', '=', $statusCustomerId);
        }
    }

    public function perusahaan()
    {
        return $this->hasOne(Perusahaan::class, 'customer_id', 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    }

    public function statusCustomer()
    {
        return $this->belongsTo(StatusCustomer::class, 'status_customer_id', 'status_customer_id');
    }
}
