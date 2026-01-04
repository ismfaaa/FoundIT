<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.home');
    }

    // method home ini hanya untuk manifestasi kalau kalau tampilan home berbeda dengan landing page
    public function home()
    {
        return view('user.home');
    }

// ======method activity untuk menampilkan halaman aktivitas user========
    public function profile()
    {
        return view('user.profile');
    }

    public function activity()
    {
        // Mengambil postingan buatan sendiri
        $myPostings = Item::where('user_id', Auth::id())->latest()->get();

        // Mengambil riwayat klaim yang diajukan sendiri
        $myClaims = \App\Models\Claim::with('item')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('user.my-activity', compact('myPostings', 'myClaims'));
    }

    public function updateProfile(Request $request)
    {
        // 1. Ambil ID user yang lagi login
        $id = Auth::id(); 
        
        // 2. Cari user berdasarkan ID (Ini bikin editor tau kalau ini Model User)
        $user = User::findOrFail($id); 

        // 3. Update dengan data yang ada di request saja
        // Kita pake $request->all() tapi divalidasi dulu biar aman
        $user->update($request->only(['username', 'domisili']));

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto_user' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Pakai User::find biar editor tau ini adalah object Model User
        $user = User::find(Auth::id());

        if ($request->hasFile('foto_user')) {
            // Hapus foto lama jika ada
            if ($user->foto_user) {
                // Perhatikan folder: kalau di kodingan 'public/foto', 
                // maka di folder storage harus ada folder 'foto'
                Storage::delete('foto/' . $user->foto_user);
            }

            $file = $request->file('foto_user');
            $nama_file = time() . '_' . $user->username . '.' . $file->getClientOriginalExtension();
            
            // Simpan ke storage/app/public/foto
            $file->storeAs('foto', $nama_file, 'public');

            // Update database
            $user->foto_user = $nama_file;
            $user->save(); // Pake save() katanya lebih ampuh ngilangin error merah dibanding update()
        }

        return redirect()->back()->with('success', 'Foto berhasil diganti!');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
