<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
    public function index() {
        $items = Item::paginate(2);
        return view('dashboard.items.index', ['items' => $items]);
    }

    public function create() {
        return view('dashboard.items.create');
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'nama_item' => ['required', 'string', 'max:255'],
            'harga_sewa' => ['required', 'string'],
            'satuan_waktu' => ['required', 'string'],
            'satuan_item' => ['required', 'string'],
            'harga_barang' => ['required', 'string'],
            'keterangan' => ['sometimes', 'nullable'],
        ]);
        
        try {
            // Memanggil metode createCustomer dari model
            $item = Item::createItem($validatedData);

            // Notifikasi berhasil
            Alert::toast('Data Item ID: ' . $item->item_id . ' berhasil ditambahkan', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.items.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing item data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan data item. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data item.']);
        }
    }

    public function edit(Item $item){
        return view('dashboard.items.edit', ['item' => $item]);
    }

    public function update(Request $request, Item $item){
        $validatedData = $request->validate([
            'nama_item' => ['required', 'string', 'max:255'],
            'harga_sewa' => ['required', 'string'],
            'satuan_waktu' => ['required', 'string'],
            'satuan_item' => ['required', 'string'],
            'harga_barang' => ['required', 'string'],
            'keterangan' => ['sometimes', 'nullable'],
        ]);

        try {
            // Memanggil metode createCustomer dari model
            $item->updateItem($validatedData);

            // Notifikasi berhasil
            Alert::toast('Data Item ID: ' . $item->item_id . ' berhasil diedit', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.items.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing item data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat mengedit data item. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data item.']);
        }
    }
}
