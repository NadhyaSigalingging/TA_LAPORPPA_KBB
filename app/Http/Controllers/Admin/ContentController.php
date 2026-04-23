<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (LIST DATA)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $contents = Content::with('category')->latest()->get();

        return view('auth.admin.content.index', compact('contents'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE FORM
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $categories = Category::all();

        return view('auth.admin.content.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE DATA
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'Judul wajib diisi',
            'body.required' => 'Isi konten wajib diisi',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('content', 'public');
        }

        Content::create([
            'title' => $request->title,
            'slug' => $request->slug ?? Str::slug($request->title),
            'body' => $request->body,
            'category_id' => $request->category_id,
            'image' => $image,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
        ]);

        return redirect()->route('auth.admin.content.index')
            ->with('success', 'Konten berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT FORM
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $content = Content::findOrFail($id);
        $categories = Category::all();

        return view('auth.admin.content.edit', compact('content', 'categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        if ($request->hasFile('image')) {
            $content->image = $request->file('image')->store('content', 'public');
        }

        $content->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Konten berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        Content::findOrFail($id)->delete();

        return back()->with('success', 'Konten berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD IMAGE (QUILL)
    |--------------------------------------------------------------------------
    */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('content', 'public');

            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }
    }
}