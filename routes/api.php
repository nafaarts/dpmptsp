<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\EditProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // user
    Route::get('/user', function (Request $request) {
        $user = $request->user();
        $user->load('penduduk');

        return [
            'nama' => $user->nama,
            'email' => $user->email,
            'nik' => $user->penduduk?->nik,
            'tempat_lahir' => $user->penduduk?->tempat_lahir,
            'tanggal_lahir' => $user->penduduk?->tanggal_lahir,
            'jenis_kelamin' => $user->penduduk?->jenis_kelamin,
            'pekerjaan' => $user->penduduk?->pekerjaan,
            'no_telpon' => $user->penduduk?->no_telpon,
            'alamat' => $user->penduduk?->alamat,
        ];
    });

    // pengaduan
    Route::apiResource('pengaduan', PengaduanController::class)->only('index', 'store', 'show');
    Route::put('/pengaduan/{id}/selesai', [PengaduanController::class, 'updateSelesai']);

    // edit profile
    Route::put('/edit-profil', EditProfileController::class);

    // edit password
    Route::put('/edit-password', function (Request $request) {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        try {
            $request->user()->update(['password' => Hash::make($validated['password'])]);
            return response()->json([
                'message' => 'Password berhasil diubah',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    });

    // logout
    Route::post('logout', function (Request $request) {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'berhasil logout']);
    });
});
