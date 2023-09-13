<?php

namespace App\Http\Controllers\Api;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json([
            'message' => 'Success.',
            'data' => $request->user()->pengaduan()->latest()->get()->map(fn ($item) => [
                'id' => $item->id,
                'kategori' => $item->kategori,
                'nomor_referensi' => $item->nomor_referensi,
                'tanggal_kejadian' => $item->tanggal_kejadian,
                'status' => $item->status,
                'sudah_ditanggapi' => $item->tanggapan != null,
                'created_at' => $item->created_at->translatedFormat('d F Y')
            ])
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => ['required', 'string', 'max:255', 'in:reklame,oss_rba,sip_sik,imb_pbg,lainnya'],
            'nomor_referensi' => 'nullable',
            'tanggal_kejadian' => ['required', 'date', 'max:255'],
            'laporan' => ['required'],
            'alamat' => ['required'],
            'patokan' => ['nullable'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'foto_bukti.*' => ['nullable', 'image', 'max:5120'],
        ]);

        try {
            $validated['user_id'] = auth()->id();
            $pengaduan = Pengaduan::create($validated);

            foreach ($request->foto_bukti ?? [] as $bukti) {
                $fileName = 'bukti/' .  time() . '-' .  $bukti->getClientOriginalName();
                $bukti->storeAs('public/', $fileName);
                $pengaduan->files()->create(['file_name' => $fileName]);
            }

            return response()->json([
                'message' => 'Pengaduan berhasil dibuat.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        return response()->json([
            'message' => 'Success.',
            'data' => $pengaduan
        ], 200);
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Pengaduan $pengaduan)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function updateSelesai(Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'selesai']);
        return response()->json([
            'message' => 'Pengaduan berhasil diselesaikan!',
            'data' => $pengaduan
        ], 200);
    }
}
