<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\BukuHarian;

use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;
use App\Http\Requests\JurnalBulananFilterRequest;
use App\Models\PostingBiaya;

class JurnalBulananController extends Controller
{
    public function index(){
        return view('dashboard.jurnal-bulanans.index');
    }

    public function filter(JurnalBulananFilterRequest $request)
    {
        $dateRange = $request->input('date_range');
        $bulanTahun = $request->input('bulan_tahun');
        $journalsQuery = PostingBiaya::with(['bukuHarians', 'groupBiaya']); // Eager load the relations

        // Cek input yang dipilih oleh pengguna
        if (!is_null($dateRange)) {
            // Jika dateRange dipilih, gunakan input tersebut untuk filter
            list($startDate, $endDate) = explode(' - ', $dateRange);

            // Konversi string ke objek DateTime
            $startDateObj = Carbon::createFromFormat('d/m/Y', $startDate);
            $endDateObj = Carbon::createFromFormat('d/m/Y', $endDate);

            // Konversi objek DateTime ke string dalam format "Y-m-d"
            $startDate = $startDateObj->format('Y-m-d');
            $endDate = $endDateObj->format('Y-m-d');

            // Set title dengan format yang diinginkan
            $title = $startDateObj->translatedFormat('d F Y') . ' - ' .  $endDateObj->translatedFormat('d F Y');

            // get journal
            $journalsQuery = $journalsQuery->whereHas('bukuHarians', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
            });
        } elseif (!is_null($bulanTahun)) {
            $title = ucfirst($bulanTahun);
            // Jika bulanTahun dipilih, gunakan input tersebut untuk filter
            $bulanTahun = $this->convertToMonthYear($bulanTahun);
            $journalsQuery = $journalsQuery->whereHas('bukuHarians', function ($query) use ($bulanTahun) {
                $query->where('tanggal_transaksi', 'LIKE', $bulanTahun . '%');
            });
        } else {
            // Jika tidak ada input yang dipilih, mungkin Anda ingin menampilkan semua data atau memberikan pesan kesalahan kepada pengguna
            // Di sini, saya akan menampilkan semua data jika tidak ada input yang dipilih
            $title = 'Semua Data';
        }

        // Hanya mengambil PostingBiaya yang memiliki BukuHarian
        $journalsQuery = $journalsQuery->has('bukuHarians');

        // Ambil data jurnal sesuai dengan filter yang dipilih
        $journals = $journalsQuery->get();

        // Menjumlahkan kredit dan debit untuk setiap PostingBiaya
        $journals = $journals->map(function($posting) {
            $posting->total_kredit = $posting->bukuHarians->sum('kredit');
            $posting->total_debit = $posting->bukuHarians->sum('debit');
            $posting->count = $posting->bukuHarians->count();
            return $posting;
        });

        // Arahkan ke view yang berbeda
        return view('dashboard.jurnal-bulanans.detail', [
            'journals' => $journals,
            'title' => $title,
        ]);
    }

    protected function convertToMonthYear($monthYearString)
    {
        // Pisahkan nama bulan dan tahun
        $parts = explode(' ', $monthYearString);
        $bulan = strtolower($parts[0]);
        $tahun = $parts[1];

        // Array untuk memetakan nama bulan ke angka bulan
        $bulanMapping = [
            'januari' => '01',
            'februari' => '02',
            'maret' => '03',
            'april' => '04',
            'mei' => '05',
            'juni' => '06',
            'juli' => '07',
            'agustus' => '08',
            'september' => '09',
            'oktober' => '10',
            'november' => '11',
            'desember' => '12',
        ];

        // Periksa apakah nama bulan ada di dalam array mapping
        if (isset($bulanMapping[$bulan])) {
            // Jika nama bulan ada, gunakan angka bulan dari array mapping
            $bulanDigit = $bulanMapping[$bulan];
            // Format bulan dan tahun ke dalam format yang diinginkan
            $monthYear = $tahun . '-' . $bulanDigit;
        } else {
            // Jika nama bulan tidak ada di dalam array mapping, berikan pesan kesalahan atau tindakan yang sesuai
            // Di sini, saya akan mengembalikan NULL jika nama bulan tidak dikenali
            $monthYear = null;
        }

        return $monthYear;
    }
    
}
