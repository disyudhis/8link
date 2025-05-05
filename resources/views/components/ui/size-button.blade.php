@props(['size', 'active' => false])

@php
    $classes = $active
        ? 'bg-green-500 text-white'
        : 'bg-gray-200 text-gray-700 hover:bg-gray-300';
@endphp

<button {{ $attributes->merge(['class' => "w-8 h-8 rounded-full $classes flex items-center justify-center text-xs font-medium"]) }}>
    {{ $size }}
</button>