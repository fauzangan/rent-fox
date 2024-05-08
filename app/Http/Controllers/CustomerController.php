<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Customer;
use App\Models\BadanHukum;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(4);

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
            'nomor_identitas' => ['required', 'string', 'unique:customers', 'max:255'],
            'jabatan' => ['sometimes', 'nullable', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:255'],
            'telp' => ['sometimes', 'nullable', 'string'],
            'fax' => ['sometimes', 'nullable', 'string'],
            'handphone' => ['required', 'string', 'unique:customers', 'max:14'],
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
                $validatedData['identitasl_berlaku'] = null;
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

        //tambahkan notifikasi ke sesi
        session()->flash('notification', [
            'title' => 'Sukses', // Tipe notifikasi: success, error, warning, info, dll.
            'message' => 'Data Customer berhasil ditambahkan!', // Pesan notifikasi
        ]);

        return redirect()->route('dashboard.customers.index');
    }


    public function detail(Customer $customer)
    {
        return view('dashboard.customers.detail');
    }

    public function edit(Customer $customer)
    {
        $badan_hukums = BadanHukum::all();
        return view('dashboard.customers.edit', [
            'customer' => $customer,
            'badan_hukums' => $badan_hukums
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis_identitas' => ['required', 'string'],
            'identitas_berlaku' => ['sometimes', 'string'],
            'nomor_identitas' => ['required', 'string', 'max:255', Rule::unique('customers')->ignore($customer)],
            'jabatan' => ['sometimes', 'nullable', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:255'],
            'telp' => ['sometimes', 'nullable', 'string'],
            'fax' => ['sometimes', 'nullable', 'string'],
            'handphone' => ['required', 'string', 'max:14', Rule::unique('customers')->ignore($customer)],
            'is_perusahaan' => ['sometimes', 'nullable'],
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

        DB::transaction(function () use ($customer, $validatedData) {
            if($customer->perusahaan_id !== null){
                Perusahaan::where('perusahaan_id', '=', $customer->perusahaan_id)->update([
                    'badan_hukum_id' => $validatedData['badan_hukum_id'],
                    'nama' => $validatedData['nama_perusahaan'],
                    'alamat' => $validatedData['alamat_perusahaan'],
                    'kota' => $validatedData['kota_perusahaan'],
                    'provinsi' => $validatedData['provinsi'],
                    'telp' => $validatedData['fax_perusahaan'],
                ]);
            }
            
            if($validatedData['jenis_identitas'] == "KTP"){
                $validatedData['identitas_berlaku'] = null;
            }
            // Perbarui data customer
            $customer->update([
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
                'perusahaan_id' => $customer->perusahaan_id,
                'keterangan' => $validatedData['keterangan'],
                'bonafidity' => $validatedData['bonafidity'],
                'bit_active' => $validatedData['bit_active'],
            ]);
        });

        session()->flash('notification', [
            'title' => 'Sukses', // Tipe notifikasi: success, error, warning, info, dll.
            'message' => 'Data Customer dengan id: '.$customer->customer_id.' berhasil diedit!', // Pesan notifikasi
        ]);
        
        return redirect()->route('dashboard.customers.index');
    }
}
