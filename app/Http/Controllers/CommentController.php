<?php
namespace App\Http\Controllers;

use id;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $blog_id)
    {
        // Validasi input komentar
        $request->validate([
            'content' => 'required|string|max:500',
            'guest_name' => 'nullable|string|max:255', // Tambahkan nama jika tidak login
        ]);
    
        // Simpan komentar tanpa auth
        Comment::create([
            'blog_id' => $blog_id,
            'user_id' => null, // Tidak perlu autentikasi
            'guest_name' => $request->guest_name, // Simpan nama pengguna anonim
            'content' => $request->content,
        ]);
    
        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
    
    
}
