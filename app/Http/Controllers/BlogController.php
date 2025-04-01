<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return "Menampilkan semua blog";
    }

    public function show($id)
    {
        return "Menampilkan detail blog dengan ID: " . $id;
    }
}