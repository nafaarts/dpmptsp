@props([
    'isActive' => false,
    'title' => '',
    'collapsible' => false,
])

@php
    $isActiveClasses = $isActive ? 'bg-white shadow-lg hover:bg-gray-100' : 'text-white hover:bg-white/25';
    
    $classes = 'flex-shrink-0 flex items-center gap-2 p-2 transition-colors rounded-md overflow-hidden ' . $isActiveClasses;
    
    if ($collapsible) {
        $classes .= ' w-full';
    }
@endphp

@if ($collapsible)
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon ?? false)
            {{ $icon }}
        @endif

        <span class="text-base font-medium whitespace-nowrap" x-show="isSidebarOpen || isSidebarHovered">
            {{ $title }}
        </span>

        <span x-show="isSidebarOpen || isSidebarHovered" aria-hidden="true" class="relative block ml-auto w-6 h-6">
            <span :class="open ? '-rotate-45' : 'rotate-45'"
                class="absolute right-[9px] bg-gray-400 mt-[-5px] h-2 w-[2px] top-1/2 transition-all duration-200"></span>

            <span :class="open ? 'rotate-45' : '-rotate-45'"
                class="absolute left-[9px] bg-gray-400 mt-[-5px] h-2 w-[2px] top-1/2 transition-all duration-200"></span>
        </span>
    </button>
@else
    <a {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon ?? false)
            {{ $icon }}
        @endif

        <span class="text-base font-medium" x-show="isSidebarOpen || isSidebarHovered">
            {{ $title }}
        </span>
    </a>
@endif
