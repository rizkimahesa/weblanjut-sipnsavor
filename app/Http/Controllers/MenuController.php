<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    public function order()
    {
        $menus = Menu::all(); // Retrieve all menu items
        return view('order', compact('menus'));
    }
    public function create()
    {
        return view('menus.create');
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
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the photo
    ]);

    $fotoPath = null; // Initialize photo path variable

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $filename = time() . '_' . $foto->getClientOriginalName(); // Generate a unique filename
        $fotoPath = $foto->move('public/images/Makanan', $filename); // Store the image in the public disk
    }

    // Create menu item
    Menu::create([
        'nama' => $request->input('nama'),
        'deskripsi' => $request->input('deskripsi'),
        'harga' => $request->input('harga'),
        'foto' => $fotoPath, // Save the path to the image
    ]);

    return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
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
            // Delete the old photo if it exists
            if ($menu->Makanan) {
                unlink(public_path($menu->Makanan)); // Ensure the correct path to delete the old image
            }
    
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->move('public/images/Makanan', $filename);
            $menu->foto = 'public/images/Makanan/' . $filename; // Update the path to the photo
        }
    
        $menu->save(); // Save the updated menu item
    
        // Redirect back to the menu list with a success message
        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
