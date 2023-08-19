<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    private function getPengaduan($kategori)
    {
        return Pengaduan::when(request('cari'), function ($query) {
            return $query->where(function ($query) {
                $query->where('nomor_referensi', 'like', '%' . request('cari') . '%')
                    ->orWhere('tanggal_kejadian', 'like', '%' . request('cari') . '%')
                    ->orWhere('laporan', 'like', '%' . request('cari') . '%')
                    ->orWhere('status', 'like', '%' . request('cari') . '%');
            });
        })
            ->where('kategori', $kategori)
            ->latest()
            ->paginate();
    }

    public function reklame()
    {
        $title = 'reklame';
        $pengaduan = $this->getPengaduan('reklame');
        return view('pengaduan.index', compact('pengaduan', 'title'));
    }

    public function ossrba()
    {
        $title = 'OSS/RBA';
        $pengaduan = $this->getPengaduan('oss_rba');
        return view('pengaduan.index', compact('pengaduan', 'title'));
    }

    public function sipsik()
    {
        $title = 'SIP/SIK';
        $pengaduan = $this->getPengaduan('sip_sik');
        return view('pengaduan.index', compact('pengaduan', 'title'));
    }

    public function imbpbg()
    {
        $title = 'IMB/PBG';
        $pengaduan = $this->getPengaduan('imb_pbg');
        return view('pengaduan.index', compact('pengaduan', 'title'));
    }

    public function lainnya()
    {
        $title = 'lainnya';
        $pengaduan = $this->getPengaduan('lainnya');
        return view('pengaduan.index', compact('pengaduan', 'title'));
    }

    public function detail(Pengaduan $pengaduan)
    {
        return view('pengaduan.detail', compact('pengaduan'));
    }

    public function tanggapan(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'tanggapan' => ['required', 'max:255'],
            'foto_bukti.*' => ['nullable', 'image', 'max:5120']
        ]);

        $tanggapan = $pengaduan->tanggapan()->create([
            'petugas_id' => auth()->id(),
            'tanggapan' => $validated['tanggapan'],
        ]);

        foreach ($request->foto_bukti ?? [] as $bukti) {
            $fileName = 'bukti/' .  time() . '-' .  $bukti->getClientOriginalName();
            $bukti->storeAs('public/', $fileName);
            $tanggapan->files()->create(['file_name' => $fileName]);
        }

        return back()->with('status', 'Pengaduan berhasil ditanggapi!');
    }
}
