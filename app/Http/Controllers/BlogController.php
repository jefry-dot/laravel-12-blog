<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
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



    public function create()
    {
        return view('blogs.add');
    }

    // Menyimpan data ke database
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'reading_time' => 'required|integer',
        'category' => 'required|string',
    ]);

    // Jika user tidak login, user_id = null
    $blog = new Blog($validated);
    $blog->user_id = auth()->id;
    $blog->save();

    return redirect()->route('blogs.index')->with('success', 'Blog berhasil dibuat!');
}

    public function edit($id)
{
    $blog = Blog::findOrFail($id);
    return view('blogs.edit', compact('blog'));
}

// Controller function untuk update data
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
    ]);

    $blog = Blog::findOrFail($id);
    $blog->title = $request->title;
    $blog->save();

    return redirect('/blogs')->with('success', 'Blog updated successfully!');
}


public function destroy($id)
{
    // Cari blog berdasarkan ID
    $blog = Blog::findOrFail($id);

    // Hapus blog dari database
    $blog->delete();

    // Redirect kembali ke halaman blog dengan pesan sukses
    return redirect('/blogs')->with('success', 'Blog berhasil dihapus!');
}

public function view($id)
{
    // Ambil data blog berdasarkan ID
    $blog = Blog::findOrFail($id);
    $blog = Blog::with('user', 'comments.user')->findOrFail($id);
    // Kirim data ke tampilan
    return view('blogs.view', compact('blog'));
}

}
