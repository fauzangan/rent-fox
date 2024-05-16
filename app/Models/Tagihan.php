<?php

namespace App\Models;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tagihan extends Model
{
    use HasFactory;

    protected $primaryKey = 'tagihan_id';

    protected $guarded = ['tagihan_id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function jenisTagihan()
    {
        return $this->belongsTo(JenisTagihan::class, 'jenis_tagihan_id');
    }

    public function statusTagihan()
    {
        return $this->belongsTo(StatusTagihan::class, 'status_tagihan_id');
    }

    public static function createTagihan($data)
    {
        // konversi string to float dan menghilangkan prefix
        $data['jumlah_tagihan'] = (float)str_replace(',', '.', str_replace('.', '', $data['jumlah_tagihan']));
        if (isset($data['total_dp'])) {
            $data['total_dp'] = (float)str_replace(',', '.', str_replace('.', '', $data['total_dp']));
            if (!is_null($data['dp1'])) {
                $data['dp1'] = (float)str_replace(',', '.', str_replace('.', '', $data['dp1']));
            }
            if (!is_null($data['dp2'])) {
                $data['dp2'] = (float)str_replace(',', '.', str_replace('.', '', $data['dp2']));
            }
            if (!is_null($data['dp3'])) {
                $data['dp3'] = (float)str_replace(',', '.', str_replace('.', '', $data['dp3']));
            }
        }else{
            $data['total_dp'] = null;
            $data['dp1'] = null;
            $data['dp2'] = null;
            $data['dp3'] = null;
        }

        // Konversi string to Date
        $data['tanggal_ditagihkan'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_ditagihkan'])->format('Y-m-d');
        $data['jatuh_tempo_1'] = DateTime::createFromFormat('d/m/Y', $data['jatuh_tempo_1'])->format('Y-m-d');
        $data['jatuh_tempo_2'] = DateTime::createFromFormat('d/m/Y', $data['jatuh_tempo_2'])->format('Y-m-d');
        
        return DB::transaction(function () use ($data) {
            return Tagihan::create([
                'order_id' => $data['order_id'],
                'jenis_tagihan_id' => $data['jenis_tagihan_id'],
                'tanggal_ditagihkan' => $data['tanggal_ditagihkan'],
                'jatuh_tempo_1' => $data['jatuh_tempo_1'],
                'jatuh_tempo_2' => $data['jatuh_tempo_2'],
                'status_tagihan_id' => $data['status_tagihan_id'],
                'jumlah_tagihan' => $data['jumlah_tagihan'],
                'keterangan' => $data['keterangan'],
                'total_dp' => $data['total_dp'],
                'dp1' => $data['dp1'],
                'dp2' => $data['dp2'],
                'dp3' => $data['dp3']
            ]);
        });
    }
}
