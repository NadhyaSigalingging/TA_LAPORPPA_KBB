<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Category;
use App\Models\Comment;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::where('status','publish');

        // 🔍 SEARCH
        if ($request->search) {
            $query->where('title','like','%'.$request->search.'%');
        }

        // 🏷 FILTER CATEGORY
        if ($request->category) {
            $query->where('category_id',$request->category);
        }

        $posts = $query->latest()->paginate(5);
        $categories = Category::all();

        return view('frontend.blog.index', compact('posts','categories'));
    }

    public function detail($slug)
    {
        $post = Content::where('slug',$slug)->firstOrFail();
        return view('frontend.blog.detail', compact('post'));
    }

    public function comment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'comment' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi',
            'comment.required' => 'Komentar wajib diisi',
        ]);

        Comment::create([
            'content_id' => $request->content_id,
            'name' => $request->name,
            'comment' => $request->comment
        ]);

        return back()->with('success','Komentar berhasil dikirim');
    }
}