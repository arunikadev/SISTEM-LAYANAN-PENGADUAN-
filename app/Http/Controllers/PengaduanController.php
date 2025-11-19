<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduans = auth()->user()->pengaduans()->latest()->paginate(15);

        // 2. Hitung statistik untuk kartu dashboard
        //    Kita hitung dari data $pengaduans yang sudah diambil
        $total = $pengaduans->count();
        
        $proses = $pengaduans->where('status', 'processing')->count();
        
        $selesai = $pengaduans->where('status', 'done')->count();

        // 3. Kirim semua data ke view 'dashboard.blade.php'
        return view('dashboard', [
            'pengaduans' => $pengaduans,
            'total' => $total,
            'proses' => $proses,
            'selesai' => $selesai,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opsional, maks 2MB
        ]);

        $path = null;
        // 2. Cek & Simpan Lampiran (jika ada)
        if ($request->hasFile('lampiran')) {
            // Simpan file ke folder 'public/lampiran'
            // 'lampiran' adalah nama folder di dalam 'storage/app/public/'
            $path = $request->file('lampiran')->store('lampiran', 'public');
        }

        // 3. Simpan data ke database
        // Kita gunakan relasi 'pengaduans()' dari user yang sedang login
        auth()->user()->pengaduans()->create([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'],
            'lampiran' => $path, // Simpan path file, atau null jika tidak ada
            'status' => 'pending' // Status awal
        ]);

        // 4. (Nanti di sini kita tambahkan Notifikasi WA ke Admin)

        // 5. Kembalikan ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Pengaduan berhasil dikirim!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if (auth()->id() !== $pengaduan->user_id) {
        abort(403, 'ANDA TIDAK DIIZINKAN MENGAKSES HALAMAN INI');
        }

    // Jika lolos, kirim data pengaduan ke view 'show'
    return view('pengaduan.show', [
        'pengaduan' => $pengaduan
    ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
