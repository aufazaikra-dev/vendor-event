<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // 1. Tampilkan Galeri Portofolio
    public function index()
    {
        $vendorId = Auth::user()->vendor->id;
        $portofolio = Project::where('vendor_id', $vendorId)->latest()->get();
        return view('vendor.portofolio.index', compact('portofolio'));
    }

    // 2. Tampilkan Form Upload
    public function create()
    {
        return view('vendor.portofolio.create');
    }

    // 3. Proses Upload & Simpan Database
    public function store(Request $request)
    {
        // Validasi: Pastikan yang diupload BUKAN virus, tapi benar-benar gambar (max 2MB)
        $request->validate([
            'judul_project' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string'
        ]);

        // Proses Upload Gambar ke folder 'public/portofolio'
        $imagePath = $request->file('cover_image')->store('portofolio', 'public');

        // Simpan ke Database
        Project::create([
            'vendor_id' => Auth::user()->vendor->id,
            'judul_project' => $request->judul_project,
            'cover_image' => $imagePath, // Simpan nama path-nya saja
            'deskripsi' => $request->deskripsi,
            'tanggal_acara' => now(), // Otomatis tanggal hari ini
        ]);

        return redirect()->route('portofolio.index')->with('success', 'Portofolio berhasil diupload! Skor SAW Anda akan naik.');
    }

    // 4. Hapus Portofolio & Hapus File Gambar
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Keamanan: Cek apakah ini benar-benar portofolio miliknya
        if($project->vendor_id != Auth::user()->vendor->id) {
            abort(403);
        }

        // Hapus file fisik gambar dari folder
        if (Storage::disk('public')->exists($project->cover_image)) {
            Storage::disk('public')->delete($project->cover_image);
        }

        // Hapus data dari database
        $project->delete();

        return redirect()->back()->with('success', 'Portofolio berhasil dihapus.');
    }
}
