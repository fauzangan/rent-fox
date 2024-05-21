<?php

namespace App\Models;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogistikHarian extends Model
{
    use HasFactory;

    protected $primaryKey = 'logistik_harian_id';

    protected $guarded = ['logistik_harian_id'];

    protected $casts = [
        'tanggal_transaksi' => 'date'
    ];

    public function logistik(){
        return $this->belongsTo(Logistik::class, 'logistik_id', 'logistik_id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function statusLogistik(){
        return $this->belongsTo(StatusLogistik::class, 'status_logistik_id', 'status_logistik_id');
    }

    public static function createLogistikHarian($data){
        $data['tanggal_transaksi'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_transaksi'])->format('Y-m-d');
        if($data['status_logistik_id'] == 2){
            if($data['baik'] > 0){
                $data['baik'] = -(int)$data['baik'];
            }
            if($data['x_ringan'] > 0){
                $data['x_ringan'] = -(int)$data['x_ringan'];
            }
            if($data['x_berat'] > 0){
                $data['x_berat'] = -(int)$data['x_berat'];
            }
        }else{
            if($data['baik'] < 0){
                $data['baik'] = -(int)$data['baik'];
            }
            if($data['x_ringan'] < 0){
                $data['x_ringan'] = -(int)$data['x_ringan'];
            }
            if($data['x_berat'] < 0){
                $data['x_berat'] = -(int)$data['x_berat'];
            }
        }
        return DB::transaction(function() use($data) {
            $logistik = Logistik::where('item_id', '=', $data['item_id'])->first();
            $logistikHarian = LogistikHarian::create([
                'logistik_id' => $logistik->logistik_id,
                'status_logistik_id' => $data['status_logistik_id'],
                'tanggal_transaksi' => $data['tanggal_transaksi'],
                'order_id' => $data['order_id'],
                'baik' => $data['baik'],
                'x_ringan' => $data['x_ringan'],
                'x_berat' => $data['x_berat'],
                'jumlah_item' => $data['jumlah_item']
            ]);

            return $logistikHarian;
        });
    }

    public function updateLogistikHarian($data)
{
    $data['tanggal_transaksi'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_transaksi'])->format('Y-m-d');
    
    // Adjust values based on status_logistik_id
    if($data['status_logistik_id'] == 2){
        if($data['baik'] > 0){
            $data['baik'] = -(int)$data['baik'];
        }
        if($data['x_ringan'] > 0){
            $data['x_ringan'] = -(int)$data['x_ringan'];
        }
        if($data['x_berat'] > 0){
            $data['x_berat'] = -(int)$data['x_berat'];
        }
    }else{
        if($data['baik'] < 0){
            $data['baik'] = -(int)$data['baik'];
        }
        if($data['x_ringan'] < 0){
            $data['x_ringan'] = -(int)$data['x_ringan'];
        }
        if($data['x_berat'] < 0){
            $data['x_berat'] = -(int)$data['x_berat'];
        }
    }

    return DB::transaction(function() use($data) {
        $logistikHarian = $this;
        // Update Logistik Harian
        $logistikHarian->update([
            'logistik_id' => $data['logistik_id'],
            'status_logistik_id' => $data['status_logistik_id'],
            'tanggal_transaksi' => $data['tanggal_transaksi'],
            'order_id' => $data['order_id'],
            'baik' => $data['baik'],
            'x_ringan' => $data['x_ringan'],
            'x_berat' => $data['x_berat'],
            'jumlah_item' => $data['jumlah_item']
        ]);


        return $logistikHarian;
    });
}
}
