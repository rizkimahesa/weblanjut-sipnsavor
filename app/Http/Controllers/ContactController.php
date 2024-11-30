<?php
namespace App\Http\Controllers;

use App\Models\Pesan; // Pastikan menggunakan model Pesan yang benar
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Ambil semua pesan dari tabel pesan
        $pesans = Pesan::with('user')->get(); // Mengambil semua pesan dengan relasi user

        // Kirim data pesans ke view
        return view('menus.pesan', compact('pesans'));
    }

    public function store(Request $request)
    {
        // Validasi input pesan
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Simpan pesan ke dalam tabel pesan
        Pesan::create([
            'user_id' => auth()->id(), // Jika menggunakan sistem login
            'message' => $validated['message'],
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Your message has been sent to the admin.');
    }
    public function destroy($id)
    {
        // Temukan pesan berdasarkan ID
        $pesan = Pesan::findOrFail($id);

        // Hapus pesan
        $pesan->delete();

        // Redirect kembali ke halaman pesan dengan pesan sukses
        return redirect()->route('pesan.index')->with('success', 'Pesan telah dihapus.');
    }
}