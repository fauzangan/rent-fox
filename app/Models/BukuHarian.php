<?php

namespace App\Models;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuHarian extends Model
{
    use HasFactory;

    protected $primaryKey = 'buku_harian_id';

    protected $guarded = ['buku_harian_id'];

    protected $casts = [
        'tanggal_transaksi' => 'date',
    ];

    public function postingBiaya(){
        return $this->belongsTo(PostingBiaya::class, 'posting_biaya_id', 'posting_biaya_id');
    }

    public function dataBukuHarian(){
        return $this->belongsTo(DataBukuHarian::class, 'data_buku_harian_id', 'data_buku_harian_id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function scopeFilterByOrderId(Builder $query, $orderId)
    {
        if ($orderId) {
            $query->where('order_id', '=', $orderId);
        }
    }

    public function scopeFilterByCustomerId(Builder $query, $customerId)
    {
        if ($customerId) {
            $query->whereHas('order', function($q) use($customerId) {
                $q->where('customer_id', '=', $customerId);
            });
        }
    }

    public function scopeFilterByTanggalTransaksi(Builder $query, $tanggalTransaksi)
    {
        if($tanggalTransaksi) {
            list($startDate, $endDate) = explode(' - ', $tanggalTransaksi);
            // Ubah format tanggal menjadi "YYYY-MM-DD" untuk query
            $startDate = DateTime::createFromFormat('d/m/Y', $startDate)->format('Y-m-d');
            $endDate = DateTime::createFromFormat('d/m/Y', $endDate)->format('Y-m-d');
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        }
    }

    public function scopeFilterByGroupBiayaId(Builder $query, $groupBiayaId)
    {
        if ($groupBiayaId) {
            $query->whereHas('postingBiaya', function($q) use($groupBiayaId) {
                $q->where('group_biaya_id', '=', $groupBiayaId);
            });
        }
    }

    public function scopeFilterByPostingBiayaId(Builder $query, $postingBiayaId)
    {
        if ($postingBiayaId) {
            $query->where('posting_biaya_id', '=', $postingBiayaId);
        }
    }

    public function scopeFilterByKeterangan(Builder $query, $keterangan)
    {
        if ($keterangan) {
            $query->where('keterangan', 'like', '%' . $keterangan . '%');
        }
    }

    public static function createBukuHarian($data) {
        // Konversi String to Int debit dan kredit
        $data['debit'] = $data['debit'] = (int)str_replace(',', '.', str_replace('.', '', $data['debit']));
        $data['kredit'] = $data['kredit'] = (int)str_replace(',', '.', str_replace('.', '', $data['kredit']));

        // Mengambil data saldo dari database buku harian
        $kredit = BukuHarian::sum('kredit');
        $debit = BukuHarian::sum('debit');
        $data['saldo'] = $kredit - $debit;

        // Operasi untuk menambah saldo atau mengurangi saldo berdasarkan data debit dan kredit
        if($data['kredit'] > 0){
            $data['saldo'] += $data['kredit'];
        }else if ($data['debit'] > 0) {
            $data['saldo'] -= $data['debit'];
        }

        // Konversi tanggal transaksi string menjadi date di database
        $data['tanggal_transaksi'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_transaksi'])->format('Y-m-d');

        return DB::transaction(function () use($data) {
            return BukuHarian::create($data);
        });
    }

    public function updateBukuHarian($data){
        // Konversi String to Int debit dan kredit
        $data['debit'] = $data['debit'] = (int)str_replace(',', '.', str_replace('.', '', $data['debit']));
        $data['kredit'] = $data['kredit'] = (int)str_replace(',', '.', str_replace('.', '', $data['kredit']));

        // Mengambil data saldo dari database buku harian
        $kredit = BukuHarian::sum('kredit') - $this->kredit;
        $debit = BukuHarian::sum('debit') - $this->debit;
        $data['saldo'] = $kredit - $debit;

        // Operasi untuk menambah saldo atau mengurangi saldo berdasarkan data debit dan kredit
        if($data['kredit'] > 0){
            $data['saldo'] += $data['kredit'];
        }else if ($data['debit'] > 0) {
            $data['saldo'] -= $data['debit'];
        }

        // Konversi tanggal transaksi string menjadi date di database
        $data['tanggal_transaksi'] = DateTime::createFromFormat('d/m/Y', $data['tanggal_transaksi'])->format('Y-m-d');

        return DB::transaction(function () use($data) {
            return $this->update($data);
        });
    }
}
