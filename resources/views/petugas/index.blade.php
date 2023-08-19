<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Petugas') }}
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
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-4">
                        Email
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
                @forelse ($petugas as $item)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $item->nama }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->created_at->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <a href="{{ route('petugas.edit', $item) }}"
                                    class="font-medium text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('petugas.destroy', $item) }}" method="post"
                                    onsubmit="return confirm('apakah anda yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="font-medium text-red-600 hover:underline p-0">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <td colspan="4" class="px-6 py-10">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $petugas->links() }}

    <a href="{{ route('petugas.create') }}"
        class="fixed flex items-center justify-center bottom-10 right-10 h-16 w-16 bg-blue-900 hover:bg-blue-800 text-white text-2xl rounded-full">
        <i class="fas fa-fw fa-plus"></i>
    </a>

</x-app-layout>
