<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::latest()->get();
        return view('auth.admin.content.index', compact('contents'));
    }

    public function create()
    {
        return view('auth.admin.content.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'image' => 'image'
        ]);

        $data = new Content();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->type = $request->type;
        $data->tanggal_upload = now();
        $data->user_id = Auth::id(); // 🔥 otomatis user login

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('content'), $name);
            $data->image = $name;
        }

        $data->save();

        return redirect()->route('auth.admin.content.index')
            ->with('success','Konten berhasil ditambahkan');
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);
        return view('auth.admin.content.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        $content->title = $request->title;
        $content->description = $request->description;
        $content->type = $request->type;

        if ($request->hasFile('image')) {
            if ($content->image) {
                File::delete(public_path('content/'.$content->image));
            }

            $file = $request->file('image');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('content'), $name);
            $content->image = $name;
        }

        $content->save();

        return redirect()->route('auth.admin.content.index')
            ->with('success','Konten berhasil diupdate');
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);

        if ($content->image) {
            File::delete(public_path('content/'.$content->image));
        }

        $content->delete();

        return back()->with('success','Konten dihapus');
    }
}