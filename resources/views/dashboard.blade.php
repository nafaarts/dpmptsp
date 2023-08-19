<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex flex-col md:flex-row gap-3">
        <a href="{{ route('pengaduan.reklame') }}" class="p-4 bg-white hover:bg-gray-100 transition shadow w-full">
            <h5 class="text-md text-gray-500 mb-1">Reklame</h5>
            <h2 class="text-3xl font-bold">
                {{ $total['reklame'] ?? '0' }}
            </h2>
        </a>
        <a href="{{ route('pengaduan.oss_rba') }}" class="p-4 bg-white hover:bg-gray-100 transition shadow w-full">
            <h5 class="text-md text-gray-500 mb-1">OSS/RBA</h5>
            <h2 class="text-3xl font-bold">
                {{ $total['oss_rba'] ?? '0' }}
            </h2>
        </a>
        <a href="{{ route('pengaduan.sip_sik') }}" class="p-4 bg-white hover:bg-gray-100 transition shadow w-full">
            <h5 class="text-md text-gray-500 mb-1">SIP/SIK</h5>
            <h2 class="text-3xl font-bold">
                {{ $total['sip_sik'] ?? '0' }}
            </h2>
        </a>
        <a href="{{ route('pengaduan.imb_pbg') }}" class="p-4 bg-white hover:bg-gray-100 transition shadow w-full">
            <h5 class="text-md text-gray-500 mb-1">IMB/PBG</h5>
            <h2 class="text-3xl font-bold">
                {{ $total['imb_pbg'] ?? '0' }}
            </h2>
        </a>
        <a href="{{ route('pengaduan.lainnya') }}" class="p-4 bg-white hover:bg-gray-100 transition shadow w-full">
            <h5 class="text-md text-gray-500 mb-1">Lainnya</h5>
            <h2 class="text-3xl font-bold">
                {{ $total['lainnya'] ?? '0' }}
            </h2>
        </a>
    </div>
</x-app-layout>
