<?php

use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpdateStatusPengaduanController;
use App\Models\Pengaduan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    $pengaduan = Pengaduan::all();
    $total['reklame'] = $pengaduan->where('kategori', 'reklame')->count();
    $total['oss_rba'] = $pengaduan->where('kategori', 'oss_rba')->count();
    $total['sip_sik'] = $pengaduan->where('kategori', 'sip_sik')->count();
    $total['imb_pbg'] = $pengaduan->where('kategori', 'imb_pbg')->count();
    $total['lainnya'] = $pengaduan->where('kategori', 'lainnya')->count();

    return view('dashboard', compact('total'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // petugas
    Route::resource('petugas', PetugasController::class)->except('show')->parameters([
        'petugas' => 'user'
    ]);

    // pengaduan
    Route::get('/pengaduan/reklame', [PengaduanController::class, 'reklame'])->name('pengaduan.reklame');
    Route::get('/pengaduan/oss_rba', [PengaduanController::class, 'ossrba'])->name('pengaduan.oss_rba');
    Route::get('/pengaduan/sip_sik', [PengaduanController::class, 'sipsik'])->name('pengaduan.sip_sik');
    Route::get('/pengaduan/imb_pbg', [PengaduanController::class, 'imbpbg'])->name('pengaduan.imb_pbg');
    Route::get('/pengaduan/lainnya', [PengaduanController::class, 'lainnya'])->name('pengaduan.lainnya');
    Route::get('/pengaduan/{pengaduan}/detail', [PengaduanController::class, 'detail'])->name('pengaduan.detail');
    Route::post('/pengaduan/{pengaduan}/tanggapan', [PengaduanController::class, 'tanggapan'])->name('pengaduan.tanggapan');
    Route::put('/pengaduan/{pengaduan}/update-status', UpdateStatusPengaduanController::class)->name('pengaduan.update-status');

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// useless routes
// Just to demo sidebar dropdown links active states.
require __DIR__ . '/auth.php';
