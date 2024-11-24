<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menus.admin.index', compact('menus')); // Path diperbaiki
    }

    /**
     * Show the dashboard.
     */
    public function dashboard()
    {
        $menus = Menu::all(); // Retrieve all menu items
        return view('dashboard', compact('menus')); // Path diperbaiki
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menus.admin.create'); // Path diperbaiki
    }

    /**
     * Display the page for ordering.
     */
    public function pesan()
    {
        // Ambil data kontak dari database
        $contacts = Contact::all();
        
        // Ambil data menu untuk ditampilkan
        $menus = Menu::all();
        
        // Kirim data kontak dan menu ke view
        return view('menus.admin.pesan', compact('menus', 'contacts'));
    }

    /**
     * Display the confirmation page.
     */
    public function konfirmasi()
    {
        return view('menus.admin.konfirmasi'); // Path diperbaiki
    }

    public function view()
    {
        return view('menus.admin.view'); // Path diperbaiki
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('images/Makanan', $filename, 'public'); // Simpan gambar di storage/public
        }

        Menu::create([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'foto' => $fotoPath,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('menus.admin.show', compact('menu')); // Path diperbaiki
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menus.admin.edit', compact('menu')); // Path diperbaiki
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $menu->nama = $request->nama;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
                Storage::disk('public')->delete($menu->foto);
            }

            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('images/Makanan', $filename, 'public');
            $menu->foto = $fotoPath;
        }

        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
            Storage::disk('public')->delete($menu->foto); // Hapus foto dari storage
        }

        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
