<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'nama' => 'required|string|max:255',
            'role' => 'required|string',
            'gaji' => 'required|numeric|min:0',
        ]);
    
        // Generate username (nama + angka random)
        $username = Str::slug($attributes['nama'], '') . rand(100, 999);
    
        // Generate password (acak 8 karakter)
        $password = Str::random(8);
    
        // Simpan ke database
        Karyawan::create([
            'nama' => $attributes['nama'],
            'role' => $attributes['role'],
            'username' => $username,
            'password' => $password,
            'gaji' => $attributes['gaji'],
        ]);
    
        // Redirect ke halaman karyawan dengan notifikasi
        return redirect()->route('karyawan')->with(
            'success',
            'Data Karyawan berhasil ditambahkan! Username: ' . $username . ', Password: ' . $password
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
        $attributes = $request->validate([
            'nama' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'nullable',
            'gaji' => 'required|numeric',
        ]);
    
        $karyawan = Karyawan::findOrFail($id);
    
        $karyawan->update([
            'nama' => $attributes['nama'],
            'role' => $attributes['role'],
            'username' => $attributes['username'],
            'password' => $attributes['password'] ?: $karyawan->password,
            'gaji' => $attributes['gaji'],
        ]);
    
        return redirect()->route('karyawan')->with('success', 'Data Karyawan updated successfully!');
    }

    public function delete($id)
    {
        Karyawan::where('id', $id)->delete();
        return redirect('/karyawan')->with('success', 'Data Karyawan deleted successfully!');
    }
}
