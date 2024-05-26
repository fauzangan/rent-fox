<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tagihan extends Model
{
    use HasFactory;

    protected $primaryKey = 'tagihan_id';

    protected $guarded = ['tagihan_id'];

    protected $casts = [
        'tanggal_ditagihkan' => 'date',
        'jatuh_tempo_1' => 'date',
        'jatuh_tempo_2' => 'date',
    ];
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

    public function scopeFilterByTagihanId(Builder $query, $tagihanId){
        if($tagihanId){
            $query->where('tagihan_id', '=', $tagihanId);
        }
    }

    public function scopeFilterByOrderId(Builder $query, $orderId){
        if($orderId){
            $query->where('order_id', '=', $orderId);
        }
    }

    public function scopeFilterByCustomerId(Builder $query, $customerId){
        if($customerId){
            $query->whereHas('order.customer', function($q) use($customerId) {
                $q->where('customer_id', '=', $customerId);
            });
        }
    }

    public function scopeFilterByCustomerName(Builder $query, $customerName){
        if($customerName){
            $query->whereHas('order.customer', function($q) use($customerName) {
                $q->where('nama', 'like', '%' . $customerName . '%');
            });
        }
    }

    public function scopeFilterByPerusahaanName(Builder $query, $perusahaanName){
        if($perusahaanName){
            $query->whereHas('order.customer.perusahaan', function($q) use($perusahaanName) {
                $q->where('nama', 'like', '%' . $perusahaanName . '%');
            });
        }
    }

    public function scopeFilterByJenisTagihanId(Builder $query, $jenisTagihanId){
        if($jenisTagihanId){
            $query->where('jenis_tagihan_id', '=', $jenisTagihanId);
        }
    }

    public function scopeFilterByStatusTagihanId(Builder $query, $statusTagihanId){
        if($statusTagihanId){
            $query->where('status_tagihan_id', '=', $statusTagihanId);
        }
    }

    public function scopeFilterByTanggalDitagihkan(Builder $query, $tanggalDitagihkan)
    {
        if($tanggalDitagihkan) {
            list($startDate, $endDate) = explode(' - ', $tanggalDitagihkan);
            // Ubah format tanggal menjadi "YYYY-MM-DD" untuk query
            $startDate = DateTime::createFromFormat('d/m/Y', $startDate)->format('Y-m-d');
            $endDate = DateTime::createFromFormat('d/m/Y', $endDate)->format('Y-m-d');
            $query->whereBetween('tanggal_ditagihkan', [$startDate, $endDate]);
        }
    }

    public function scopeFilterByJatuhTempo1(Builder $query, $jatuhTempo1)
    {
        if($jatuhTempo1) {
            list($startDate, $endDate) = explode(' - ', $jatuhTempo1);
            // Ubah format tanggal menjadi "YYYY-MM-DD" untuk query
            $startDate = DateTime::createFromFormat('d/m/Y', $startDate)->format('Y-m-d');
            $endDate = DateTime::createFromFormat('d/m/Y', $endDate)->format('Y-m-d');
            $query->whereBetween('jatuh_tempo_1', [$startDate, $endDate]);
        }
    }

    public function scopeFilterByJatuhTempo2(Builder $query, $jatuhTempo2)
    {
        if($jatuhTempo2) {
            list($startDate, $endDate) = explode(' - ', $jatuhTempo2);
            // Ubah format tanggal menjadi "YYYY-MM-DD" untuk query
            $startDate = DateTime::createFromFormat('d/m/Y', $startDate)->format('Y-m-d');
            $endDate = DateTime::createFromFormat('d/m/Y', $endDate)->format('Y-m-d');
            $query->whereBetween('jatuh_tempo_2', [$startDate, $endDate]);
        }
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
