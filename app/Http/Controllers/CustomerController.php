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
        $customers = Customer::with('perusahaan')->orderBy('customer_id', 'desc')->paginate(4);
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

        try {
            // Memanggil metode createCustomer dari model
            $customer = Customer::createCustomer($validatedData);

            // Notifikasi berhasil
            Alert::toast('Data Customer ID: ' . $customer->customer_id . ' berhasil ditambahkan', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.customers.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing customer data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan data customer. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data customer.']);
        }
    }

    public function getCustomerDetails(Customer $customer)
    {
        // Eager load relasi 'perusahaan' saat mengambil data customer
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

        try {
            // Panggil metode updateCustomer dari model
            $customer->updateCustomer($validatedData);

            // Notifikasi berhasil
            Alert::toast('Customer ID: ' . $customer->customer_id . ' berhasil di-update', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.customers.index');
        } catch (\Exception $e) {
            // Tangani pengecualian
            Log::error('Error in updating customer data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat memperbarui data customer. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data customer.']);
        }
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
                } else {
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
