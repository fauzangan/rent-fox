<?php

namespace App\Http\Controllers;

use App\Models\BadanHukum;
use App\Models\Customer;
use App\Models\Perusahaan;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return view('dashboard.customers.index', [
            'customers' => $customers,
            
        ]);
    }

    public function create()
    {
        $badan_hukums = BadanHukum::all();
        
        return view('dashboard.customers.create', [
            'badan_hukums' => $badan_hukums,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis_identitas' => ['required', 'string'],
            'identitas_berlaku' => ['sometimes', 'string'],
            'nomor_identitas' => ['required', 'string', 'max:255'],
            'jabatan' => ['sometimes', 'nullable', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:255'],
            'telp' => ['sometimes', 'nullable', 'string'],
            'fax' => ['sometimes', 'nullable', 'string'],
            'handphone' => ['required', 'string', 'max:14'],
            'is_perusahaan' => ['required', 'nullable'],
            'surat_kuasa' => ['required'],
            'badan_hukum_id' => ['sometimes'],
            'nama_perusahaan' => ['sometimes', 'string', 'max:255'],
            'alamat_perusahaan' => ['sometimes', 'string', 'max:255'],
            'kota_perusahaan' => ['sometimes', 'string', 'max:255'],
            'provinsi_perusahaan' => ['sometimes', 'string'],
            'telp_perusahaan' => ['sometimes', 'nullable'],
            'fax_perusahaan' => ['sometimes', 'nullable'],
            'keterangan' => ['sometimes', 'nullable'],
            'bonafidity' => ['required', 'string'],
            'bit_active' => ['required', 'boolean']
        ]);

        DB::transaction(function () use ($validatedData) {
            if ($validatedData['is_perusahaan']) {
                $perusahaan = Perusahaan::create([
                    'badan_hukum_id' => $validatedData['badan_hukum_id'],
                    'nama' => $validatedData['nama_perusahaan'],
                    'alamat' => $validatedData['alamat_perusahaan'],
                    'kota' => $validatedData['kota_perusahaan'],
                    'provinsi' => $validatedData['provinsi'],
                    'telp' => $validatedData['fax_perusahaan'],
                ]);

                $validatedData['perusahaan_id'] = $perusahaan->perusahaan_id;
            } else {
                $validatedData['perusahaan_id'] = null;
            }

            if ($validatedData['jenis_identitas'] == "KTP") {
                $validatedData['identitas_berlaku'] = null;
            }

            Customer::create([
                'nama' => $validatedData['nama'],
                'jenis_identitas' => $validatedData['jenis_identitas'],
                'identitas_berlaku' => $validatedData['identitas_berlaku'],
                'nomor_identitas' => $validatedData['nomor_identitas'],
                'jabatan' => $validatedData['jabatan'],
                'alamat' => $validatedData['alamat'],
                'kota' => $validatedData['kota'],
                'provinsi' => $validatedData['provinsi'],
                'telp' => $validatedData['telp'],
                'fax' => $validatedData['fax'],
                'handphone' => $validatedData['handphone'],
                'perusahaan_id' => $validatedData['perusahaan_id'],
                'keterangan' => $validatedData['keterangan'],
                'bonafidity' => $validatedData['bonafidity'],
                'bit_active' => $validatedData['bit_active']
            ]);
        });
        
        return redirect()->route('dashboard.customers.index');
    }
}
