@props([
    'variant' => 'primary',
    'iconOnly' => false,
    'srText' => '',
    'href' => false,
    'size' => 'base',
    'disabled' => false,
    'pill' => false,
    'squared' => false,
])

@php
    
    $baseClasses = 'inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white';
    
    switch ($variant) {
        case 'primary':
            $variantClasses = 'bg-blue-900 text-white hover:bg-blue-800 focus:ring-blue-900';
            break;
        case 'secondary':
            $variantClasses = 'bg-gray-200 text-gray-900 hover:bg-gray-300 focus:ring-blue-900';
            break;
        case 'success':
            $variantClasses = 'bg-green-900 text-white hover:bg-green-800 focus:ring-green-900';
            break;
        case 'danger':
            $variantClasses = 'bg-red-900 text-white hover:bg-red-800 focus:ring-red-900';
            break;
        case 'warning':
            $variantClasses = 'bg-yellow-900 text-white hover:bg-yellow-800 focus:ring-yellow-900';
            break;
        case 'info':
            $variantClasses = 'bg-cyan-900 text-white hover:bg-cyan-800 focus:ring-cyan-900';
            break;
        case 'black':
            $variantClasses = 'bg-black text-gray-300 hover:text-white hover:bg-gray-800 focus:ring-black';
            break;
        default:
            $variantClasses = 'bg-blue-900 text-white hover:bg-blue-800 focus:ring-blue-900';
    }
    
    switch ($size) {
        case 'sm':
            $sizeClasses = $iconOnly ? 'p-1.5' : 'px-2.5 py-1.5 text-sm';
            break;
        case 'base':
            $sizeClasses = $iconOnly ? 'p-2' : 'px-4 py-2 text-base';
            break;
        case 'lg':
        default:
            $sizeClasses = $iconOnly ? 'p-3' : 'px-5 py-2 text-xl';
            break;
    }
    
    $classes = $baseClasses . ' ' . $sizeClasses . ' ' . $variantClasses;
    
    if (!$squared && !$pill) {
        $classes .= ' rounded-md';
    } elseif ($pill) {
        $classes .= ' rounded-full';
    }
    
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if ($iconOnly)
            <span class="sr-only">{{ $srText ?? '' }}</span>
        @endif
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
        @if ($iconOnly)
            <span class="sr-only">{{ $srText ?? '' }}</span>
        @endif
    </button>
@endif
