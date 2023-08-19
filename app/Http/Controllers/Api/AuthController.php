<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => 'required|string|min:8',
            'nik' => ['required', 'string', 'max:255', 'unique:' . Penduduk::class],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date', 'max:255'],
            'jenis_kelamin' => ['required', 'string', 'max:1'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'no_telpon' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create($validatedData);

        $user->penduduk()->create([
            'nik' => $validatedData['nik'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'pekerjaan' => $validatedData['pekerjaan'] ?? null,
            'no_telpon' => $validatedData['no_telpon'],
            'alamat' => $validatedData['alamat'],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    public function login(Request $request)
    {
        if (!Auth::attempt([
            ...$request->only('email', 'password'),
            'hak_akses' => "penduduk"
        ])) {
            return response()->json([
                'message' => 'Detail login tidak valid'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Berhasil logout.'
        ], 200);
    }
}
