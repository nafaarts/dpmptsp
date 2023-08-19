<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petugas = User::when(request('cari'), function ($query) {
            $query->where(function ($query) {
                $query->where('nama', 'like', '%' . request('cari') . '%')
                    ->orWhere('email', 'like', '%' . request('cari') . '%');
            });
        })
            ->where('hak_akses', 'petugas')
            ->whereNot('id', auth()->id())
            ->latest()
            ->paginate();

        return view('petugas.index', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $validated['hak_akses'] = 'petugas';

        User::create($validated);

        return redirect()->route('petugas.index')->with('status', 'Petugas berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('petugas.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        if (!$validated['password']) {
            $validated['password'] = $user->password;
        }

        $user->update($validated);

        return redirect()->route('petugas.index')->with('status', 'Petugas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('petugas.index')->with('status', 'Petugas berhasil dihapus');
    }
}
