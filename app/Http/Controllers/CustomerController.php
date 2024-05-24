<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerFilterRequest;
use DateTime;
use App\Models\Customer;
use App\Models\BadanHukum;
use App\Models\Perusahaan;
use App\Models\Provinsi;
use App\Models\StatusCustomer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index(CustomerFilterRequest $request)
    {
        $customers = Customer::query()
            ->with('perusahaan')
            ->with('statusCustomer')
            ->filterByCustomerId($request->input('customer_id'))
            ->filterByName($request->input('nama'))
            ->filterByNomorIdentitas($request->input('nomor_identitas'))
            ->filterByHandphone($request->input('handphone'))
            ->filterByPerusahaan($request->input('nama_perusahaan'))
            ->filterByBonafidity($request->input('bonafidity'))
            ->filterByStatusCustomer($request->input('status_customer_id'))
            ->orderBy('customer_id', 'desc')
            ->paginate(10)
            ->appends($request->except('page'));

        $statusCustomers = StatusCustomer::all();

        confirmDelete("Apakah anda yakin menghapus ?", "Data yang sudah dihapus tidak dapat dikembalikan");

        return view('dashboard.customers.index', [
            'customers' => $customers,
            'status_customers' => $statusCustomers
        ]);
    }

    public function create()
    {
        $provinsis = Provinsi::all();
        $statusCustomers = StatusCustomer::all();
        return view('dashboard.customers.create', [
            'provinsis' => $provinsis,
            'status_customers' => $statusCustomers
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
            'is_perusahaan' => ['required'],
            'surat_kuasa' => ['required'],
            'badan_hukum' => ['sometimes', 'nullable', 'string'],
            'nama_perusahaan' => ['sometimes', 'nullable', 'string', 'max:255'],
            'alamat_perusahaan' => ['sometimes', 'nullable', 'string', 'max:255'],
            'kota_perusahaan' => ['sometimes', 'nullable', 'string', 'max:255'],
            'provinsi_perusahaan' => ['sometimes', 'nullable', 'string'],
            'telp_perusahaan' => ['sometimes', 'nullable'],
            'fax_perusahaan' => ['sometimes', 'nullable'],
            'keterangan' => ['sometimes', 'nullable'],
            'bonafidity' => ['required', 'string'],
            'status_customer_id' => ['required', 'integer']
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

    public function edit(Customer $customer)
    {
        $statusCustomers = StatusCustomer::all();
        return view('dashboard.customers.edit', [
            'status_customers' => $statusCustomers,
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
            'status_customer_id' => ['required', 'integer']
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

    public function getCustomerDetails(Customer $customer)
    {
        // Eager load relasi 'perusahaan' saat mengambil data customer
        $customer->load('perusahaan');

        // Mengembalikan data customer dalam format JSON
        return response()->json($customer);
    }

    public function destroy(Customer $customer)
    {
        try {
            DB::transaction(function () use ($customer) {
                $customer->delete();
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
