<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class UpdateStatusPengaduanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $pengaduan->update([
            'status' => $request->status
        ]);

        return back()->with('status', 'Status pengaduan berhasil diubah!');
    }
}
