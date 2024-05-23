<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class TotalLogistik extends Model
{
    use HasFactory;

    protected $primaryKey = 'total_logistik_id';

    protected $guarded = ['total_logistik_id'];

    protected $casts = [
        'tanggal_transaksi' => 'date'
    ];

    public static function createTotalLogistik($data){
        $data['tanggal_transaksi'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_transaksi'])->format('Y-m-d');
        if($data['status_total_logistik_id'] == 2){
            if($data['jumlah_item'] > 0){
                $data['jumlah_item'] = -(int)$data['jumlah_item'];
            }
        }else{
            if($data['jumlah_item'] < 0){
                $data['jumlah_item'] = -(int)$data['jumlah_item'];
            }
        }

        return DB::transaction(function() use($data) {
            $totalLogistik = TotalLogistik::create([
                'status_total_logistik_id' => $data['status_total_logistik_id'],
                'tanggal_transaksi' => $data['tanggal_transaksi'],
                'logistik_id' => $data['logistik_id'],
                'jumlah_item' => $data['jumlah_item'],
                'keterangan' => $data['keterangan'],
                'data_total_logistik_id' => $data['data_total_logistik_id'],
                'vendor' => $data['vendor'],
            ]);

            // ambil data logistik
            $logistik = Logistik::with('totalLogistiks')->where('logistik_id', $totalLogistik->logistik_id)->first();
            
            

            // Perhitungan Logistik untuk total Log dan claim Hilang
            $totalLog = $logistik->totalLogistiks()->where('data_total_logistik_id', 1)->sum('jumlah_item');
            $claimHilang = $logistik->totalLogistiks()->where('data_total_logistik_id', 2)->sum('jumlah_item');
            $logistik->update([
                'total_log' => $totalLog,
                'claim_hilang' => $claimHilang,
                'total_stock' => $logistik->stock_awal + $totalLog + $claimHilang,
            ]);

            // // perhitungan stock logistik ASR
            // if($totalLogistik->data_total_logistik_id == 1){
            //     $totalLog = $logistik->totalLogistiks()->where('data_total_logistik_id', 1)->sum('jumlah_item');
            //     $logistik->update([
            //         'total_log' => $totalLog,
            //         'total_stock' => $logistik->stock_awal + $totalLog + $logistik->claim_hilang,
            //     ]);
            // }else if($totalLogistik->data_total_logistik_id == 2){
            //     $claimHilang = $logistik->totalLogistiks()->where('data_total_logistik_id', 2)->sum('jumlah_item');
            //     $logistik->update([
            //         'claim_hilang' => $claimHilang,
            //         'total_stock' => $logistik->stock_awal + $logistik->total_log + $claimHilang,
            //     ]);
            // }
            
            return $totalLogistik;
        });
    }

    public function updateTotalLogistik($data){
        $data['tanggal_transaksi'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_transaksi'])->format('Y-m-d');
        if($data['status_total_logistik_id'] == 2){
            if($data['jumlah_item'] > 0){
                $data['jumlah_item'] = -(int)$data['jumlah_item'];
            }
        }else{
            if($data['jumlah_item'] < 0){
                $data['jumlah_item'] = -(int)$data['jumlah_item'];
            }
        }

        DB::transaction(function() use($data){
            $this->update([
                'status_total_logistik_id' => $data['status_total_logistik_id'],
                'tanggal_transaksi' => $data['tanggal_transaksi'],
                'logistik_id' => $data['logistik_id'],
                'jumlah_item' => $data['jumlah_item'],
                'keterangan' => $data['keterangan'],
                'data_total_logistik_id' => $data['data_total_logistik_id'],
                'vendor' => $data['vendor'],
            ]);

            // ambil data logistik
            $logistik = Logistik::with('totalLogistiks')->where('logistik_id', $this->logistik_id)->first();

            // Perhitungan Logistik untuk total Log dan claim Hilang
            $totalLog = $logistik->totalLogistiks()->where('data_total_logistik_id', 1)->sum('jumlah_item');
            $claimHilang = $logistik->totalLogistiks()->where('data_total_logistik_id', 2)->sum('jumlah_item');
            $logistik->update([
                'total_log' => $totalLog,
                'claim_hilang' => $claimHilang,
                'total_stock' => $logistik->stock_awal + $totalLog + $claimHilang,
            ]);
            
        });
    }

    public function logistik()
    {
        return $this->belongsTo(Logistik::class, 'logistik_id', 'logistik_id');
    }

    public function statusTotalLogistik()
    {
        return $this->belongsTo(StatusTotalLogistik::class, 'status_total_logistik_id', 'status_total_logistik_id');
    }

    public function dataTotalLogistik()
    {
        return $this->belongsTo(DataTotalLogistik::class, 'data_total_logistik_id', 'data_total_logistik_id');
    }
}
