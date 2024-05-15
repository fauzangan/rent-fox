<?php

namespace App\Http\Controllers;

use App\Models\CategoryItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
    public function index() {
        $items = Item::with('categoryItem')->paginate(10);
        return view('dashboard.items.index', ['items' => $items]);
    }

    public function create() {
        $category_items = CategoryItem::all();
        return view('dashboard.items.create', ['category_items' => $category_items]);
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'nama_item' => ['required', 'string', 'max:255'],
            'category_item_id' => ['required'],
            'harga_sewa' => ['required', 'string'],
            'satuan_waktu' => ['required', 'string'],
            'satuan_item' => ['required', 'string'],
            'harga_barang' => ['required', 'string'],
            'keterangan' => ['sometimes', 'nullable'],
        ]);
        
        try {
            // Memanggil metode createItem dari model
            $item = Item::createItem($validatedData);

            // Notifikasi berhasil
            Alert::success('Data Item ID: ' . $item->item_id . ' berhasil ditambahkan', 'success');

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
        $categoryItem = CategoryItem::all();
        return view('dashboard.items.edit', ['item' => $item, 'category_items' => $categoryItem]);
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
            Alert::success('Data Item ID: ' . $item->item_id . ' berhasil diedit', 'success');

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
