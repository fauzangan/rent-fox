<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostingBiaya extends Model
{
    use HasFactory;

    protected $primaryKey = 'posting_biaya_id';

    public $incrementing = false;

    protected $fillable = [
        'posting_biaya_id',
        'group_biaya_id',
        'keterangan'
    ];

    public function groupBiaya(){
        return $this->belongsTo(GroupBiaya::class, 'group_biaya_id', 'group_biaya_id');
    }

    public function bukuHarians(){
        return $this->hasMany(BukuHarian::class, 'posting_biaya_id', 'posting_biaya_id');
    }

    // Override the boot method to add logic before creating a new item
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($postingBiaya) {
            self::generatePostingBiayaId($postingBiaya);
        });

    }

    public static function generatePostingBiayaId($posting)
    {
        $groupBiaya = GroupBiaya::find($posting->group_biaya_id);
        $prefiks = $groupBiaya->prefiks;

        // Dapatkan ID terakhir untuk kategori ini
        $lastPosting = $groupBiaya->postingBiayas()->orderBy('posting_biaya_id', 'desc')->first();
        if ($lastPosting) {
            $lastNumber = intval(substr($lastPosting->posting_biaya_id, strlen($prefiks))) + 1;
        } else {
            $lastNumber = 1;
        }

        // Buat ID baru
        $posting->posting_biaya_id = $prefiks . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
    }

    public static function createPostingBiaya($data){
        return DB::transaction(function() use($data) {
            $postingBiaya = PostingBiaya::create([
                'nama_posting' => $data['nama_posting'],
                'group_biaya_id' => $data['group_biaya_id'],
                'keterangan' => $data['keterangan'] ?? '-'
            ]); 

            return $postingBiaya;
        });
    }

}
