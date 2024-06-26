<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMahasiswa; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pointakses.user.index');
    }

    public function showFormMahasiswa()
    {
        $user_id = Auth::id();
        $datamahasiswa = DataMahasiswa::where('user_id', $user_id)->first();
        $isAdmin = false;
        if (Auth::check()) {
            $isAdmin = Auth::user()->role === 'admin';
        }

        if ($datamahasiswa) {
            return redirect()->route('datamahasiswa')->with('message', 'Data instructor sudah diisi.');
        } else {
            return view('user.user_mahasiswa_form', compact('isAdmin'));
        }
    }

    public function storeMahasiswa(Request $request)
    {
        // Validasi Data
        $request->validate([
            'nama_lengkap' => 'required|min:3',
            'email' => 'required|email|unique:datamahasiswa,email',
            'nim' => 'required|numeric|digits_between:1,10|unique:datamahasiswa,nim',
            'angkatan' => 'required|digits:4',
            'jurusan' => 'required',
            'tanggal_lahir' => 'nullable|date',
            'gambar' => 'required|image|file|max:1024',
        ], [
            'nama_lengkap.required' => 'Nama wajib diisi',
            'nama_lengkap.min' => 'Nama minimal harus 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM harus berupa angka',
            'nim.digits_between' => 'NIM harus terdiri dari 1-10 digit',
            'angkatan.required' => 'Angkatan wajib diisi',
            'angkatan.digits' => 'Angkatan harus berupa 4 digit angka',
            'jurusan.required' => 'Jurusan wajib diisi',
            'tanggal_lahir.date' => 'Format Tanggal Lahir tidak valid',
            'gambar.required' => 'Gambar wajib di upload',
            'gambar.image' => 'Gambar yang di upload harus image',
            'gambar.file' => 'Gambar harus berupa file',
            'gambar.max' => 'Ukuran gambar maksimal 1MB',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar_file = $request->file('gambar');
            $foto_ekstensi = $gambar_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $gambar_file->move(public_path('picture/accounts'), $nama_foto);
            $gambar = $nama_foto;
        } else {
            $gambar = "user.jpeg";
        }

        $user_id = Auth::id();
        DataMahasiswa::create([
            'user_id' => $user_id,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'jurusan' => $request->jurusan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gambar' => $gambar,
        ]);

        return redirect()->route('datamahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function showLoginForm()
    {
        return view('halaman_auth.login');
    }
}
