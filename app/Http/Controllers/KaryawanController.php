<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();

        // Sorting (Optional, jika diperlukan)
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }

        $sortDirection = request('direction', 'desc'); 
        $karyawan = $query->orderBy('created_at', $sortDirection)->paginate(5);

        return view('pages.karyawan.index', compact('karyawan'));
    }

    public function add()
    {
        return view('pages.karyawan.add');
    }

    public function create(Request $request)
    {
        // Validasi data input
        $attributes = $request->validate([
            'username' => 'required|string|max:255',
            'role' => 'required|string',
            'gaji' => 'required|numeric|min:0',
        ]);
    
        // Generate email (nama + angka random)
        $email = Str::slug($attributes['username'], '') . rand(100, 999).'@gmail.com';
    
        // Generate password (acak 8 karakter)
        $password = Str::random(8);
    
        // Simpan ke database
        Karyawan::create([
            'username' => $attributes['username'],
            'role' => $attributes['role'],
            'email' => $email,
            'password' => $password,
            'gaji' => $attributes['gaji'],
        ]);

        User::create([
            'username' => $attributes['username'],
            'email' => $email,
            'password' => $password,
            'role' => $attributes['role'],
        ]);
    
        // Redirect ke halaman karyawan dengan notifikasi
        return redirect()->route('karyawan')->with(
            'success',
            'Data Karyawan berhasil ditambahkan! Username: ' . $attributes['username'] . ', Password: ' . $password
        );
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return redirect('/karyawan')->with('error', 'Karyawan not found');
        }

        return view('pages.karyawan.edit', compact('karyawan'));
    }

    public function update($id, Request $request)
    {
        $karyawan = Karyawan::findOrFail($id);

        $attributes = $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($karyawan->email, 'email'),
            ],
            'role' => 'required',
            'username' => 'required',
            'password' => 'nullable',
            'gaji' => 'required|numeric',
        ]);
    
    
        $oldEmail = $karyawan->email;
    
        $karyawan->update([
            'email' => $attributes['email'],
            'role' => $attributes['role'],
            'username' => $attributes['username'],
            'password' => $attributes['password'] ?: $karyawan->password,
            'gaji' => $attributes['gaji'],
        ]);
    
        $user = User::where('email', $oldEmail)->first();
    
        if ($user) {
            $user->update([
                'email' => $attributes['email'],
                'role' => $attributes['role'],
                'username' => $attributes['username'],
                'password' => $attributes['password'] ? bcrypt($attributes['password']) : $user->password,
            ]);
        }
    
        return redirect()->route('karyawan')->with('success', 'Data Karyawan updated successfully!');
    }

    public function delete($id)
    {

        $karyawan = Karyawan::findOrFail($id);
    

        User::where('email', $karyawan->email)->delete();
    

        $karyawan->delete();
    
        return redirect('/karyawan')->with('success', 'Data Karyawan deleted successfully!');
    }
    
}
