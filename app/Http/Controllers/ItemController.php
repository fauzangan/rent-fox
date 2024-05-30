<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemFilterRequest;
use App\Models\Item;
use App\Models\CategoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
    public function index(ItemFilterRequest $request)
    {
        $categoryItems = CategoryItem::all();
        $items = Item::query()
        ->with(['categoryItem', 'logistik'])
        ->filterByItemId($request->input('item_id'))
        ->filterByName($request->input('nama_item'))
        ->filterByCategoryItemId($request->input('category_item_id'))
        ->paginate(10)
        ->appends($request->except('page'));
        confirmDelete("Apakah anda yakin menghapus Item ?", "Data yang berelasi akan ikut terhapus dan tidak bisa dikembalikan");
        return view('dashboard.items.index', [
            'items' => $items,
            'category_items' => $categoryItems
        ]);
    }

    public function create()
    {
        $category_items = CategoryItem::all();
        return view('dashboard.items.create', ['category_items' => $category_items]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nama_item' => ['required', 'string', 'max:255'],
            'category_item_id' => ['required'],
            'harga_sewa' => ['required', 'string'],
            'satuan_waktu' => ['required', 'string'],
            'satuan_item' => ['required', 'string'],
            'harga_barang' => ['required', 'string'],
            'x_ringan' => ['required'],
            'x_berat' => ['required', 'integer'],
            'hilang' => ['required', 'integer'],
            'stock_awal' => ['required', 'integer'],
            'keterangan' => ['sometimes', 'nullable'],
        ]);

        $item = Item::createItem($validatedData);
        try {
            // Memanggil metode createItem dari model

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

    public function edit(Item $item)
    {
        $categoryItem = CategoryItem::all();
        return view('dashboard.items.edit', ['item' => $item, 'category_items' => $categoryItem]);
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'nama_item' => ['required', 'string', 'max:255'],
            'category_item_id' => ['required', 'exists:category_items,category_item_id'],
            'harga_sewa' => ['required', 'string'],
            'satuan_waktu' => ['required', 'string'],
            'satuan_item' => ['required', 'string'],
            'harga_barang' => ['required', 'string'],
            'x_ringan' => ['required'],
            'x_berat' => ['required'],
            'hilang' => ['required'],
            'total_log' => ['sometimes', 'nullable'],
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

    public function destroy(Item $item)
    {
        return back();
        try {
            // Hapus Item
            $item->delete();

            // Memberikan feedback kepada pengguna
            alert()->success('Delete Berhasil', 'item ID: ' . $item->item_id . ' telah dihapus!');
            
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi selama penghapusan
            alert()->error('Delete Gagal', 'Terjadi kesalahan saat menghapus item.');

            // Anda dapat melakukan log kesalahan di sini jika perlu
            Log::error('Kesalahan saat menghapus item: ' . $e->getMessage());
        }
        return back();
    }
}
