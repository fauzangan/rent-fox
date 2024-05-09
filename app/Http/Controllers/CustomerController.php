<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Customer;
use App\Models\BadanHukum;
use App\Models\Perusahaan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(4);
        confirmDelete("Apakah anda yakin menghapus ?", "Data yang sudah dihapus tidak dapat dikembalikan");
        return view('dashboard.customers.index', [
            'customers' => $customers,

        ]);
    }

    public function create()
    {
        $provinsis = Provinsi::all();
        return view('dashboard.customers.create', [
            'provinsis' => $provinsis
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
            'badan_hukum' => ['sometimes', 'string'],
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

        $customer = DB::transaction(function () use ($validatedData) {
            if ($validatedData['is_perusahaan']) {
                $perusahaan = Perusahaan::create([
                    'badan_hukum' => $validatedData['badan_hukum'],
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
            }else{
                $validatedData['identitas_berlaku'] = DateTime::createFromFormat('d/m/Y', $validatedData['identitas_berlaku'])->format('Y-m-d');
            }

            return Customer::create([
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
        Alert::toast('Data Customer ID: ' . $customer->customer_id .' berhasil ditambahkan', 'success');
        return redirect()->route('dashboard.customers.index');
    }

    public function getCustomerDetails(Customer $customer)
    {
        // Eager load relasi 'perusahaan' bersama dengan relasi 'perusahaan.badanHukum' saat mengambil data customer
        $customer->load('perusahaan');

        // Mengembalikan data customer dalam format JSON
        return response()->json($customer);
    }

    public function edit(Customer $customer)
    {
        return view('dashboard.customers.edit', [
            'customer' => $customer,
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
            'badan_hukum' => ['sometimes', 'string'],
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
            if ($customer->perusahaan_id !== null) {
                Perusahaan::where('perusahaan_id', '=', $customer->perusahaan_id)->update([
                    'badan_hukum' => $validatedData['badan_hukum'],
                    'nama' => $validatedData['nama_perusahaan'],
                    'alamat' => $validatedData['alamat_perusahaan'],
                    'kota' => $validatedData['kota_perusahaan'],
                    'provinsi' => $validatedData['provinsi'],
                    'telp' => $validatedData['fax_perusahaan'],
                ]);
            }

            if ($validatedData['jenis_identitas'] == "KTP") {
                $validatedData['identitas_berlaku'] = null;
            }else{
                $validatedData['identitas_berlaku'] = DateTime::createFromFormat('d/m/Y', $validatedData['identitas_berlaku'])->format('Y-m-d');
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

        Alert::toast('Customer ID: ' . $customer->customer_id . ' Berhasil di Edit', 'success');
        return redirect()->route('dashboard.customers.index');
    }

    public function destroy(Customer $customer)
    {
        try {
            DB::transaction(function () use ($customer) {

                // cek jika terikat dengan perusahaan atau tidak ?
                if ($customer->perusahaan_id !== null) {
                    // mencari id perusahaan dan hapus
                    $perusahaanID = $customer->perusahaan_id;
                    // Hapus Customer yang berkaitan dengan ID
                    $customer->delete();
                    Perusahaan::where('perusahaan_id', '=', $perusahaanID)->delete();
                }else {
                    $customer->delete();
                }
            });

            // Memberikan feedback kepada pengguna
            alert()->success('Delete Berhasil', 'Customer ID: ' . $customer->customer_id . ' telah dihapus!');
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi selama penghapusan
            alert()->error('Delete Gagal', 'Terjadi kesalahan saat menghapus customer.');

            // Anda dapat melakukan log kesalahan di sini jika perlu
            Log::error('Kesalahan saat menghapus customer: ' . $e->getMessage());
        }
        return back();
    }
}
