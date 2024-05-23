<?php

namespace App\Models;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $guarded = ['order_id'];

    protected $casts = [
        'tanggal_order' => 'date',
        'tanggal_kirim' => 'date'
    ];

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function tagihans(){
        return $this->hasMany(Tagihan::class, 'order_id', 'order_id');
    }

    public function statusOrder() {
        return $this->belongsTo(StatusOrder::class, 'status_order_id', 'status_order_id');
    }

    public function statusTransport() {
        return $this->belongsTo(StatusTransport::class, 'status_transport_id', 'status_transport_id');
    }

    public static function createOrderWithItems($data){
        $data['tanggal_order'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_order'])->format('Y-m-d');
        $data['tanggal_kirim'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_kirim'])->format('Y-m-d');
        for($i = 0; $i < count($data['jumlah_hargas']); $i++){
            $data['jumlah_hargas'][$i] = $data['jumlah_hargas'][$i] = (int)str_replace(',', '.', str_replace('.', '', $data['jumlah_hargas'][$i]));
        } 

        return DB::transaction(function() use($data){
            $order = Order::create([
                'tanggal_order' => $data['tanggal_order'],
                'tanggal_kirim' => $data['tanggal_kirim'],
                'customer_id' => $data['customer_id'],
                'nama_customer' => $data['nama_customer'],
                'identitas_customer' => $data['identitas_customer'],
                'alamat_customer' => $data['alamat_customer'],
                'kota_customer' => $data['kota_customer'],
                'telp_customer' => $data['telp_customer'],
                'fax_customer' => $data['fax_customer'],
                'handphone_customer' => $data['handphone'],
                'badan_hukum' => $data['badan_hukum'],
                'nama_perusahaan' => $data['nama_perusahaan'],
                'alamat_perusahaan' => $data['alamat_perusahaan'],
                'kota_perusahaan' => $data['kota_perusahaan'],
                'telp_perusahaan' => $data['telp_perusahaan'],
                'fax_perusahaan' => $data['fax_perusahaan'],
                'kirim_kepada' => $data['kirim_kepada'],
                'nama_proyek' => $data['nama_proyek'],
                'alamat_kirim' => $data['alamat_kirim'],
                'status_transport_id' => $data['status_transport_id'],
                'status_order_id' => $data['status_order_id'],
                'keterangan' => $data['keterangan'],
            ]);

            if(isset($data['items'])){
                for($i = 0; $i < count($data['items']); $i++){
                    $item = Item::where('item_id', '=', $data['items'][$i])->first();
                    OrderItem::create([
                        'order_id' => $order->order_id,
                        'item_id' => $item->item_id,
                        'nama_item' => $item->nama_item,
                        'harga_sewa' => $item->harga_sewa,
                        'harga_barang' => $item->harga_barang,
                        'x_ringan' => $item->x_ringan,
                        'x_berat' => $item->x_berat,
                        'hilang' => $item->hilang,
                        'satuan' => $item->satuan_item,
                        'waktu' => $data['waktus'][$i],
                        'jumlah_item' => $data['jumlah_items'][$i],
                        'jumlah_harga' => $data['jumlah_hargas'][$i]
                    ]);
                }
            }
            return $order;
        });
    }

    public static function updateOrderWithItem($order , $data){
        $data['tanggal_order'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_order'])->format('Y-m-d');
        $data['tanggal_kirim'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_kirim'])->format('Y-m-d');
        for($i = 0; $i < count($data['jumlah_hargas']); $i++){
            $data['jumlah_hargas'][$i] = $data['jumlah_hargas'][$i] = (int)str_replace(',', '.', str_replace('.', '', $data['jumlah_hargas'][$i]));
        } 

        DB::transaction(function() use($order, $data) {
            $order->update([
                'tanggal_order' => $data['tanggal_order'],
                'tanggal_kirim' => $data['tanggal_kirim'],
                'customer_id' => $data['customer_id'],
                'nama_customer' => $data['nama_customer'],
                'identitas_customer' => $data['identitas_customer'],
                'alamat_customer' => $data['alamat_customer'],
                'kota_customer' => $data['kota_customer'],
                'telp_customer' => $data['telp_customer'],
                'fax_customer' => $data['fax_customer'],
                'handphone' => $data['handphone'],
                'badan_hukum' => $data['badan_hukum'],
                'nama_perusahaan' => $data['nama_perusahaan'],
                'alamat_perusahaan' => $data['alamat_perusahaan'],
                'kota_perusahaan' => $data['kota_perusahaan'],
                'telp_perusahaan' => $data['telp_perusahaan'],
                'fax_perusahaan' => $data['fax_perusahaan'],
                'kirim_kepada' => $data['kirim_kepada'],
                'alamat_kirim' => $data['alamat_kirim'],
                'nama_proyek' => $data['nama_proyek'],
                'status_transport_id' => $data['status_transport_id'],
                'status_order_id' => $data['status_order_id'],
                'keterangan' => $data['keterangan'],
            ]);

            $existingItems = [];

            for($i = 0; $i < count($data['items']); $i++){
                $existingItem = $order->orderItems()->where('item_id', $data['items'][$i])->first();
                $item = Item::where('item_id', '=', $data['items'][$i])->first();
                // dd($existingItem);
                if($existingItem){
                    $existingItem->update([
                        'waktu' => $data['waktus'][$i],
                        'jumlah_item' => $data['jumlah_items'][$i],
                        'jumlah_harga' => $data['jumlah_hargas'][$i]
                    ]);
                    $existingItems[] = $data['items'][$i];
                } else {
                    $order->orderItems()->create([
                        'order_id' => $order->order_id,
                        'item_id' => $item->item_id,
                        'nama_item' => $item->nama_item,
                        'harga_sewa' => $item->harga_sewa,
                        'harga_barang' => $item->harga_barang,
                        'x_ringan' => $item->x_ringan,
                        'x_berat' => $item->x_berat,
                        'hilang' => $item->hilang,
                        'satuan' => $item->satuan_item,
                        'waktu' => $data['waktus'][$i],
                        'jumlah_item' => $data['jumlah_items'][$i],
                        'jumlah_harga' => $data['jumlah_hargas'][$i]
                    ]);
                    $existingItems[] = $data['items'][$i];
                }
            }
            $order->orderItems()->whereNotIn('item_id', $existingItems)->delete();
        });
        return $order;
    }

    
}
