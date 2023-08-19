@props([
    'title' => '',
    'active' => false,
])

@php
    
    $classes = 'transition-colors hover:text-gray-900';
    
    $active ? ($classes .= ' text-gray-900') : ($classes .= ' text-gray-500');
    
@endphp

<li class="relative leading-8 m-0 pl-6 last:before:h-auto last:before:top-4 last:before:bottom-0">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $title }}
    </a>
</li>
