<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Detail Pengaduan
            </h2>
        </div>
    </x-slot>

    <x-auth-validation-errors class="mb-4 bg-red-50 border border-red-400 rounded p-4" :errors="$errors" />

    <x-auth-session-status class="mb-4 bg-green-50 border border-green-400 rounded p-4" :status="session('status')" />

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-4">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/2">
                <table class="text-left">
                    <tr>
                        <th>Kategori</th>
                        <td class="px-3">:</td>
                        <td class="uppercase">{{ $pengaduan->kategori }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td class="px-3">:</td>
                        <td class="uppercase">{{ $pengaduan->status }}</td>
                    </tr>

                    @if ($pengaduan->nomor_referensi != null)
                        <tr>
                            <th>Nomor Referensi</th>
                            <td class="px-3">:</td>
                            <td>{{ $pengaduan->nomor_referensi ?? '-' }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Tanggal Kejadian</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->tanggal_kejadian }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Patokan</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->patokan ?? '-' }}</td>
                    </tr>
                    {{-- <tr>
                        <th>Latitude</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->latitude }}</td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->longitude }}</td>
                    </tr> --}}
                </table>
            </div>
            <div class="w-full md:w-1/2">
                <table class="text-left">
                    <tr>
                        <th>Nama pengadu</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Induk Kependudukan</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->user->penduduk->nik }}</td>
                    </tr>
                    <tr>
                        <th>Tempat/Tanggal Lahir</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->user->penduduk->tempat_lahir }},
                            {{ now()->parse($pengaduan->user->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->user->penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->user->penduduk->pekerjaan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->user->penduduk->no_telpon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td class="px-3">:</td>
                        <td>{{ $pengaduan->user->penduduk->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <style>
        .gambar-bukti {
            height: 50px;
            width: 50px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
        }
    </style>

    <div class="flex flex-col md:flex-row gap-4">
        <div class="w-full md:w-2/3 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <h4 class="font-bold mb-3">Laporan</h4>
            <div class="mb-5">
                <p>{{ $pengaduan->laporan }}</p>
                @if ($pengaduan->files->count() > 0)
                    <div class="flex gap-3 mt-6">
                        @foreach ($pengaduan->files as $item)
                            <a href="{{ asset('storage/' . $item->file_name) }}" target="_blank"
                                class="gambar-bukti rounded border border-gray-200"
                                style="background-image: url({{ asset('storage/' . $item->file_name) }});"></a>
                        @endforeach
                    </div>
                @endif
            </div>
            <hr class="h-px my-8 bg-gray-200 border-0">
            @if ($pengaduan->tanggapan)
                <div class="p-5 bg-gray-200 rounded">
                    <h4 class="font-bold mb-3">Tanggapan</h4>
                    <p>{{ $pengaduan->tanggapan->tanggapan }}</p>


                    @if ($pengaduan->tanggapan->files->count() > 0)
                        <div class="flex gap-3 mt-6">
                            @foreach ($pengaduan->tanggapan->files as $item)
                                <a href="{{ asset('storage/' . $item->file_name) }}" target="_blank"
                                    class="gambar-bukti rounded border border-gray-200"
                                    style="background-image: url({{ asset('storage/' . $item->file_name) }});"></a>
                            @endforeach
                        </div>
                    @endif

                    <small class="block text-gray-500 italic mt-4">ditanggapi oleh
                        {{ $pengaduan->tanggapan->petugas->nama }}</small>
                </div>
            @else
                <form action="{{ route('pengaduan.tanggapan', $pengaduan) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggapan" class="block mb-2 text-sm font-medium text-gray-900">Tanggapan</label>
                        <textarea id="tanggapan" rows="4" name="tanggapan"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukan tanggapan anda"></textarea>
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="foto_bukti">Lampiran
                            Bukti</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none "
                            id="foto_bukti" type="file" multiple name="foto_bukti[]">
                    </div>
                    <x-button size="sm">Kirim tanggapan</x-button>
                </form>
            @endif
        </div>

        <div class="w-full md:w-1/3 p-4 sm:p-8 bg-white shadow sm:rounded-lg h-fit">
            <h4 class="font-bold mb-3">Update Status</h4>
            <form action="{{ route('pengaduan.update-status', $pengaduan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status
                        Pengaduan</label>
                    <select id="status" name="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 uppercase">
                        @foreach (['diajukan', 'ditolak_petugas', 'diproses_petugas', 'diselesaikan_petugas', 'ditolak_pengadu', 'selesai'] as $item)
                            <option value="{{ $item }}" @selected($pengaduan->status == $item)>{{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <x-button variant="danger" size="sm">Ubah Status</x-button>
            </form>
        </div>
    </div>
</x-app-layout>
