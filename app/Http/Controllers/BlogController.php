<?php

namespace App\Http\Controllers;

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
        $blogs = $query->paginate(5)->withQueryString();

        return view('blogs', compact('blogs'));
    }
}
