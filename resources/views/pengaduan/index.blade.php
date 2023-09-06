<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Pengaduan ') }} <span class="capitalize">{{ $title ?? 'Lainnya' }}</span>
            </h2>

            <x-search />
        </div>
    </x-slot>

    <x-auth-session-status class="mb-4 bg-green-50 border border-green-400 rounded p-4" :status="session('status')" />

    <div class="relative overflow-x-auto shadow sm:rounded-lg mb-4">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr class="border-b">
                    <th scope="col" class="px-6 py-4">
                        Nama Pengadu
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Tanggal kejadian
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Tanggal dibuat
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengaduan as $item)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <div>
                                <h5 class="text-lg font-medium">{{ $item->user->nama }}</h5>
                                @if ($item->nomor_referensi != null)
                                    <p class="text-md text-gray-400">{{ $item->nomor_referensi }}</p>
                                @endif
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <span class="uppercase">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ now()->parse($item->tanggal_kejadian)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->created_at->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <x-button :href="route('pengaduan.detail', $item)" size="sm">
                                    <i class="fas fa-fw fa-eye mr-2"></i> Lihat
                                </x-button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <td colspan="5" class="px-6 py-10">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $pengaduan->links() }}

</x-app-layout>
