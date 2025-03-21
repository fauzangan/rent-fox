<?php

namespace App\Models;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservasi_id';

    protected $guarded = ['reservasi_id'];

    protected $casts = [
        'tanggal_reservasi' => 'date'
    ];

    public function statusReservasi(){
        return $this->belongsTo(StatusReservasi::class, 'status_reservasi_id', 'status_reservasi_id');
    }

    public function reservasiItems(){
        return $this->hasMany(ReservasiItem::class, 'reservasi_id', 'reservasi_id');
    }

    public function scopeFilterByTanggalReservasi(Builder $query, $tanggalReservasi)
    {
        if($tanggalReservasi) {
            list($startDate, $endDate) = explode(' - ', $tanggalReservasi);
            // Ubah format tanggal menjadi "YYYY-MM-DD" untuk query
            $startDate = DateTime::createFromFormat('d/m/Y', $startDate)->format('Y-m-d');
            $endDate = DateTime::createFromFormat('d/m/Y', $endDate)->format('Y-m-d');
            $query->whereBetween('tanggal_reservasi', [$startDate, $endDate]);
        }
    }

    public function scopeFilterByCustomerName(Builder $query, $customerName)
    {
        if ($customerName) {
            $query->where('nama_customer', 'like', '%' . $customerName . '%');
        }
    }

    public function scopeFilterByPerusahaanName(Builder $query, $perusahaanName)
    {
        if ($perusahaanName) {
            $query->where('nama_perusahaan', 'like', '%' . $perusahaanName . '%');
        }
    }

    public function scopeFilterByHandphone(Builder $query, $handphone)
    {
        if ($handphone) {
            $query->where('handphone', 'like', '%' . $handphone . '%');
        }
    }

    public static function createReservasiWithItems($data){
        $data['tanggal_reservasi'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_reservasi'])->format('Y-m-d');

        return DB::transaction(function() use($data) {
            $reservasi = Reservasi::create([
                'tanggal_reservasi' => $data['tanggal_reservasi'],
                'status_reservasi_id' => $data['status_reservasi_id'],
                'nama_customer' => $data['nama_customer'],
                'telp_customer' => $data['telp_customer'],
                'fax_customer' => $data['fax_customer'],
                'handphone' => $data['handphone'],
                'badan_hukum' => $data['badan_hukum'],
                'nama_perusahaan' => $data['nama_perusahaan'],
                'telp_perusahaan' => $data['telp_perusahaan'],
                'fax_perusahaan' => $data['fax_perusahaan'],
                'proyek' => $data['proyek'],
                'keterangan' => $data['keterangan'],
            ]);

            if(isset($data['items'])){
                for($i = 0; $i < count($data['items']); $i++){
                    $item = Item::where('item_id', '=', $data['items'][$i])->first();
                    $logistik = Logistik::where('item_id', '=', $data['items'][$i])->first();
                    ReservasiItem::create([
                        'reservasi_id' => $reservasi->reservasi_id,
                        'logistik_id' => $logistik->logistik_id,
                        'item_id' => $item->item_id,
                        'waktu' => $data['waktus'][$i],
                        'jumlah_item' => $data['jumlah_items'][$i],
                        'jumlah_harga' => $data['jumlah_hargas'][$i],
                    ]);
                }
            }
            return $reservasi;
        });
    }

    public static function updateReservasiWithItems($data, $reservasi){
        $data['tanggal_reservasi'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_reservasi'])->format('Y-m-d');

        DB::transaction(function() use($data, $reservasi){
            $reservasi->update([
                'tanggal_reservasi' => $data['tanggal_reservasi'],
                'status_reservasi_id' => $data['status_reservasi_id'],
                'nama_customer' => $data['nama_customer'],
                'telp_customer' => $data['telp_customer'],
                'fax_customer' => $data['fax_customer'],
                'handphone' => $data['handphone'],
                'badan_hukum' => $data['badan_hukum'],
                'nama_perusahaan' => $data['nama_perusahaan'],
                'telp_perusahaan' => $data['telp_perusahaan'],
                'fax_perusahaan' => $data['fax_perusahaan'],
                'proyek' => $data['proyek'],
                'keterangan' => $data['keterangan'],
            ]);

            $existingItems = [];

            for($i = 0; $i < count($data['items']); $i++){
                $existingItem = $reservasi->reservasiItems()->where('item_id', $data['items'][$i])->first();
                $item = Item::where('item_id', '=', $data['items'][$i])->first();
                $logistik = Logistik::where('item_id', '=', $data['items'][$i])->first();
                if($existingItem){
                    $existingItem->update([
                        'waktu' => $data['waktus'][$i],
                        'jumlah_item' => $data['jumlah_items'][$i],
                        'jumlah_harga' => $data['jumlah_hargas'][$i]
                    ]);
                    $existingItems[] = $data['items'][$i];
                } else {
                    $reservasi->reservasiItems()->create([
                        'reservasi_id' => $reservasi->reservasi_id,
                        'logistik_id' => $logistik->logistik_id,
                        'item_id' => $item->item_id,
                        'waktu' => $data['waktus'][$i],
                        'jumlah_item' => $data['jumlah_items'][$i],
                        'jumlah_harga' => $data['jumlah_hargas'][$i],
                    ]);
                    $existingItems[] = $data['items'][$i];
                }
            }
            $reservasi->reservasiItems()->whereNotIn('item_id', $existingItems)->delete();
        });
        return $reservasi;
    }
    
}
