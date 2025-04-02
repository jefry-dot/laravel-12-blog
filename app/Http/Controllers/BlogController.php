<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        

        $query = DB::table('blogs');

        // Ambil keyword dari input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
        }

        // Ambil data dengan pagination
        $blogs = $query->orderBy('id', 'desc')->paginate(10);
        $blogs->appends(['offset' => ($request->input('page', 1) - 1) * 10]);

        return view('blogs', compact('blogs'));
    }


    public function create()
    {
        return view('blogs.add');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/blogs')->with('success', 'Blog berhasil ditambahkan!');
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

    // Kirim data ke tampilan
    return view('blogs.view', compact('blog'));
}

}
