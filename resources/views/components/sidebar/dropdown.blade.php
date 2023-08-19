@props([
    'active' => false,
    'title' => '',
])

<div class="relative" x-data="{ open: @json($active) }">
    <x-sidebar.link collapsible title="{{ $title }}" x-on:click="open = !open" isActive="{{ $active }}">
        @if ($icon ?? false)
            <x-slot name="icon">
                {{ $icon }}
            </x-slot>
        @endif
    </x-sidebar.link>

    <div x-show="open && (isSidebarOpen || isSidebarHovered)" x-collapse>
        <ul class="relative px-0 pt-2 pb-0 ml-5">
            {{ $slot }}
        </ul>
    </div>
</div>
