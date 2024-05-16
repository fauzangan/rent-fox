<?php

namespace App\Http\Controllers;

use App\Models\CategoryItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryItemController extends Controller
{
    public function index()
    {
        $category_items = CategoryItem::all();
        return view('dashboard.category-items.index', ['category_items' => $category_items]);
    }

    public function create()
    {
        return view('dashboard.category-items.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_category' => ['required', 'string', 'max:255'],
            'prefiks' => ['required', 'string', 'max:10', 'unique:category_items'],
            'keterangan' => ['sometimes', 'nullable', 'string'],
        ]);

        try {
            // Memanggil metode createCustomer dari model
            $category_item = CategoryItem::create($validatedData);

            // Notifikasi berhasil
            Alert::success('Data Kategori Item ID: ' . $category_item->category_item_id . ' berhasil ditambahkan', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.category-items.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing category item data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan kategori item. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data kategori item.']);
        }
    }

    public function edit(CategoryItem $categoryItem)
    {
        return view('dashboard.category-items.edit', [
            'categoryItem' => $categoryItem
        ]);
    }

    public function update(Request $request, CategoryItem $categoryItem)
    {
        $validatedData = $request->validate([
            'nama_category' => ['required', 'string', 'max:255'],
            'prefiks' => ['required', 'string', 'max:10', Rule::unique('category_items')->ignore($categoryItem)],
            'keterangan' => ['sometimes', 'nullable', 'string'],
        ]);

        $categoryItem->update($validatedData);
        try {
            // Memanggil metode createCustomer dari model

            // Notifikasi berhasil
            Alert::success('Data Kategori Item ID: ' . $categoryItem->category_item_id . ' berhasil diedit', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.category-items.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing category item data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan kategori item. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data kategori item.']);
        }
    }
}
