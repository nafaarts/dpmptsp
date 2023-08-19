<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <i class="fas fa-fw fa-gauge"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Pengaduan Reklame" href="{{ route('pengaduan.reklame') }}" :isActive="request()->routeIs('pengaduan.reklame')">
        <x-slot name="icon">
            <i class="fas fa-fw fa-flag"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Pengaduan OSS/RBA" href="{{ route('pengaduan.oss_rba') }}" :isActive="request()->routeIs('pengaduan.oss_rba')">
        <x-slot name="icon">
            <i class="fas fa-fw fa-flag"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Pengaduan SIP/SIK" href="{{ route('pengaduan.sip_sik') }}" :isActive="request()->routeIs('pengaduan.sip_sik')">
        <x-slot name="icon">
            <i class="fas fa-fw fa-flag"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Pengaduan IMB/PBG" href="{{ route('pengaduan.imb_pbg') }}" :isActive="request()->routeIs('pengaduan.imb_pbg')">
        <x-slot name="icon">
            <i class="fas fa-fw fa-flag"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Pengaduan Lainnya" href="{{ route('pengaduan.lainnya') }}" :isActive="request()->routeIs('pengaduan.lainnya')">
        <x-slot name="icon">
            <i class="fas fa-fw fa-flag"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="Data Petugas" href="{{ route('petugas.index') }}" :isActive="request()->routeIs('petugas*')">
        <x-slot name="icon">
            <i class="fas fa-fw fa-user-tie"></i>
        </x-slot>
    </x-sidebar.link>

    {{-- <x-sidebar.dropdown title="Buttons" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'buttons',
    )">
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink title="Text button" href="{{ route('buttons.text') }}" :active="request()->routeIs('buttons.text')" />
        <x-sidebar.sublink title="Icon button" href="{{ route('buttons.icon') }}" :active="request()->routeIs('buttons.icon')" />
        <x-sidebar.sublink title="Text with icon" href="{{ route('buttons.text-icon') }}" :active="request()->routeIs('buttons.text-icon')" />
    </x-sidebar.dropdown> --}}

    {{-- <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">
        Dummy Links
    </div> --}}

    {{-- @php
        $links = array_fill(0, 20, '');
    @endphp

    @foreach ($links as $index => $link)
        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
    @endforeach --}}

</x-perfect-scrollbar>
