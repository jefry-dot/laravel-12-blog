<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua data user
        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk tambah user
    public function create()
    {
        return view('users.create');
    }

    // Menampilkan form untuk edit user
    public function edit($id)
{
    $user = User::findOrFail($id);
    $phone = $user->phone ? $user->phone->phone_number : ''; // Ambil nomor HP user

    return view('users.edit', compact('user', 'phone'));
}


    // Update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'phone_number' => 'nullable|string|max:15',
        ]);
    
        // Update data user
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
    
        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($validated['password'])]);
        }
    
        // Update atau buat nomor HP baru
        if ($request->filled('phone_number')) {
            $phone = Phone::updateOrCreate(
                ['user_id' => $user->id], // Cari berdasarkan user_id
                ['phone_number' => $validated['phone_number']]
            );
    
            // Jika ada phone_id di tabel users, update juga
            if (Schema::hasColumn('users', 'phone_id')) {
                $user->update(['phone_id' => $phone->id]);
            }
        }
    
        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }
    

    
    
    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Hapus user

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed', // Password harus ada dan sesuai
        ]);

        // Simpan user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
        ]);

        return redirect()->route('users.index')->with('success', 'User baru berhasil ditambahkan!');
    }
}
