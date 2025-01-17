<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    // Menampilkan seluruh folder beserta device yang terkait
    public function index()
    {
        // Mengambil semua folder dengan perangkat yang terkait
        $folders = Folder::with('devices')->get();

        // Kirim data ke view
        return view('index', compact('folders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);


        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        Folder::create($validated);

        return redirect('/')->with('success', 'Data berhasil disimpan!');
    }

    // Menampilkan detail folder
    public function show($id)
    {
        // Mengambil folder berdasarkan ID
        $folders = Folder::find($id);

        // Jika folder tidak ditemukan
        if (!$folders) {
            return redirect('/')->with('error', 'Folder tidak ditemukan!');
        }

        // Mengambil devices yang terkait dengan folder
        $devices = $folders->devices; // Menggunakan relasi untuk mengambil devices

        // Kirim data folder dan devices ke view
        return view('folders', compact('folders', 'devices'));
    }

    public function addDeviceForm($id)
    {
        // Mengambil folder berdasarkan ID
        $folders = Folder::find($id);
        // Kirim data folder dan devices ke view
        return view('add-device', compact('folders'));
    }


    // Hapus Folder
    public function destroy($id)
    {
        $folder = Folder::find($id);

        if (!$folder) {
            return redirect()->back()->with('error', 'Folder tidak ditemukan!');
        }

        $folder->delete();

        return redirect('/')->with('success', 'Folder berhasil dihapus!');
    }

    // Rename Folder
    public function rename(Request $req)
    {
        $id = $req->input('id'); // ID folder yang akan diubah namanya
        $newName = $req->input('nama'); // Nama baru folder

        // Mencari folder berdasarkan ID
        $folder = Folder::find($id);

        // Jika folder tidak ditemukan
        if (!$folder) {
            return redirect()->back()->with('error', 'Folder tidak ditemukan!');
        }

        // Update nama folder
        $folder->nama = $newName;
        $folder->save(); // Simpan perubahan

        // Kembali ke halaman sebelumnya setelah sukses
        return redirect()->back()->with('error', 'Berhasil mengganti nama!');
    }
}
