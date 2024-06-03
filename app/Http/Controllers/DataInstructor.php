<?php

namespace App\Http\Controllers;

use App\Models\DataInstructor as ModelsDataInstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DataInstructor extends Controller
{
    function index()
    {
        $data = ModelsDataInstructor::all();
        return view('data_instructor.index', ['data' => $data]);
    }
    function tambah()
    {
        return view('data_instructor.tambah');
    }
    function edit($id)
    {
        $data = ModelsDataInstructor::find($id);

        return view('data_instructor.edit', ['data' => $data]);
    }

    // DataMahasiswa.php

    public function form()
    {

    return view('user_mahasiswa_form'); 
    
    }

    function hapus(Request $request)
    {

        return redirect('/datainstructor');
    }
    // new
    function create(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|min:3',
            'email' => 'required|email|unique:datainstructor,email', // Pastikan email unik
            'nidn' => 'required|numeric|digits_between:1,10|unique:datainstructor,nidn', // Digits_between for length
            'departemen' => 'required',
            'tanggal_lahir' => 'nullable|date', // Tanggal lahir opsional
            'alamat' => 'required',
            'provinsi' => 'required',
            'kecamatan' => 'required',
            'kota_kabupaten' => 'required',
            'kode_pos' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.min' => 'Nama lengkap minimal harus 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.numeric' => 'NIDN harus berupa angka',
            'nidn.digits_between' => 'NIDN harus terdiri dari 1-10 digit',
            'departemen.required' => 'Departemen wajib diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            'alamat.required' => 'Alamat wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
            'kecamatan.required' => 'Kecamatan wajib diisi',
            'kota_kabupaten.required' => 'Kota/Kabupaten wajib diisi',
            'kode_pos.required' => 'Kode pos wajib diisi',
        ]);

        ModelsDataInstructor::insert([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'nidn' => $request->nidn,
            'departemen' => $request->departemen,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kecamatan' => $request->kecamatan,
            'kota_kabupaten' => $request->kota_kabupaten,
            'kode_pos' => $request->kode_pos,
            
        ]);
        
        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/datainstructor')->with('success', 'Berhasil Menambahkan Data');
    }
    function change(Request $request, DataInstructor $datainstructor)
    {
        $request->validate([
            'nama_lengkap' => 'required|min:3',
            'email' => 'required|email|unique:datainstructor,email', // Pastikan email unik
            'nidn' => 'required|numeric|digits_between:1,10|unique:datainstructor,nidn', // Digits_between for length
            'departemen' => 'required',
            'tanggal_lahir' => 'nullable|date', // Tanggal lahir opsional
            'alamat' => 'required',
            'provinsi' => 'required',
            'kecamatan' => 'required',
            'kota_kabupaten' => 'required',
            'kode_pos' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.min' => 'Nama lengkap minimal harus 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.numeric' => 'NIDN harus berupa angka',
            'nidn.digits_between' => 'NIDN harus terdiri dari 1-10 digit',
            'departemen.required' => 'Departemen wajib diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            'alamat.required' => 'Alamat wajib diisi',
            'provinsi.required' => 'Provinsi wajib diisi',
            'kecamatan.required' => 'Kecamatan wajib diisi',
            'kota_kabupaten.required' => 'Kota/Kabupaten wajib diisi',
            'kode_pos.required' => 'Kode pos wajib diisi',
        ]);

        $datainstructor = ModelsDataInstructor::find($request->id);
        $datainstructor->nama_lengkap = $request->nama_lengkap;
        $datainstructor->email = $request->email;
        $datainstructor->nidn = $request->nidn;
        $datainstructor->departemen = $request->departemen;
        $datainstructor->tanggal_lahir = $request->tanggal_lahir;
        $datainstructor->alamat = $request->alamat;
        $datainstructor->provinsi = $request->provinsi;
        $datainstructor->kecamatan = $request->kecamatan;
        $datainstructor->kota_kabupaten = $request->kota_kabupaten;
        $datainstructor->kode_pos = $request->kode_pos;
        $datainstructor->save();
        $datainstructor->update($request->all());

        Session::flash('success', 'Berhasil Mengubah Data');

        return redirect('/datainstructor');
    }
}
