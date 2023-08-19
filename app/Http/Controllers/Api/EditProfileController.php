<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EditProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user())],
            'nik' => ['required', 'string', 'max:255', Rule::unique(Penduduk::class)->ignore($request->user()->penduduk)],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date', 'max:255'],
            'jenis_kelamin' => ['required', 'string', 'max:1'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'no_telpon' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        try {
            // update user
            $user = User::find($request->user()->id);
            $user->update([
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email']
            ]);

            // update data penduduk
            $user->penduduk()->update([
                'nik' => $validatedData['nik'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'pekerjaan' => $validatedData['pekerjaan'] ?? null,
                'no_telpon' => $validatedData['no_telpon'],
                'alamat' => $validatedData['alamat'],
            ]);

            return response()->json([
                'message' => 'Data berhasil diubah',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
