<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Menampilkan daftar blog
    public function index(Request $request)
    {
        $query = Blog::with('user'); // Load relasi user

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
        }

        $blogs = $query->orderBy('id', 'desc')->paginate(10);

        return view('blogs', compact('blogs'));
    }

    // Menampilkan form tambah blog
    public function create()
    {
        $tags = Tag::all(); // Ambil semua tag
        return view('blogs.add', compact('tags')); // Kirim tags ke view
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'reading_time' => 'required|integer',
            'category' => 'required|string',
            'tags' => 'array',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan blog
        $blog = new Blog($validated);
        $blog->user_id = Auth::id(); // Menggunakan Auth::id() untuk user yang login

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $blog->thumbnail = $path;
        }
    
        $blog->save();

        // Simpan tag ke pivot table (jika ada)
        if ($request->has('tags')) {
            $blog->tags()->attach($request->tags);
        }

        return redirect()->route('blogs.index')->with('success', 'Blog berhasil dibuat!');
    }

    // Menampilkan halaman edit blog
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $tags = Tag::all(); // Ambil semua tag
        return view('blogs.edit', compact('blog', 'tags'));
    }

    // Controller function untuk update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'reading_time' => 'required|integer',
            'category' => 'required|string',
            'tags' => 'array',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if ($blog->thumbnail) {
                Storage::disk('public')->delete($blog->thumbnail);
            }
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $blog->thumbnail = $path;
        }
        $blog->update($request->only(['title', 'content', 'reading_time', 'category']));
        $blog->tags()->sync($request->tags ?? []);

        return redirect('/blogs')->with('success', 'Blog berhasil diperbarui!');
    }

    // Menghapus blog
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->tags()->detach(); // Hapus relasi tag
        $blog->delete();

        return redirect('/blogs')->with('success', 'Blog berhasil dihapus!');
    }

    // Menampilkan detail blog
    public function view($id)
    {
        $blog = Blog::with('user', 'tags', 'comments.user')->findOrFail($id);
        return view('blogs.view', compact('blog'));
    }
}
