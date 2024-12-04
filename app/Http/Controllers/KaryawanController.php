<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();
    
        // Sorting berdasarkan kolom dan arah
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }
    
        $sortDirection = request('direction', 'desc'); 
        $karyawan = $query->orderBy('created_at', $sortDirection)->paginate(10);

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
            'nama' => 'required',
            'role' => 'required',
            'username' => 'required|unique:karyawan',
            'password' => 'required',
            'gaji' => 'required|numeric',
        ]);
    
        // Simpan data karyawan
        Karyawan::create([
            "nama" => $attributes['nama'],
            "role" => $attributes['role'],
            "username" => $attributes['username'],
            "password" => bcrypt($attributes['password']),
            "gaji" => $attributes['gaji'],
        ]);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return redirect('/karyawan')->with('error', 'Karyawan tidak ditemukan');
        }
    
        return view('pages.karyawan.edit', compact('karyawan'));
    }

    public function update($id, Request $request)
    {
        // Validasi data input
        $attributes = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'username' => 'required|unique:karyawan,username,' . $id,
            'password' => 'nullable', // Password opsional pada update
            'salary' => 'required|numeric',
        ]);

        // Cari karyawan berdasarkan id
        $karyawan = Karyawan::findOrFail($id);

        // Perbarui data karyawan, jika password diisi
        $karyawan->update([
            "name" => $attributes['name'],
            "role" => $attributes['role'],
            "username" => $attributes['username'],
            "password" => $attributes['password'] ? bcrypt($attributes['password']) : $karyawan->password,
            "salary" => $attributes['salary'],
        ]);

        return redirect('/karyawan')->with('success', 'Karyawan berhasil diperbarui!');
    }

    public function delete($id)
    {
        Karyawan::where('id', $id)->delete();
        return redirect('/karyawan')->with('success', 'Karyawan berhasil dihapus!');
    }
}
