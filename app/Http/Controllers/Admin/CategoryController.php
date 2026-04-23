<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST KATEGORI
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $categories = Category::latest()->get();

        return view('auth.admin.category.index', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('auth.admin.category.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN KATEGORI
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.unique' => 'Kategori sudah ada'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS KATEGORI
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}