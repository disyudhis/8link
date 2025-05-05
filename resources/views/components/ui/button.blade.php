@props(['color' => 'primary', 'fullWidth' => false])

@php
$classes = match ($color) {
'primary' => 'bg-primary hover:bg-secondary text-black',
'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800',
'danger' => 'bg-red-500 hover:bg-red-600 text-white',
default => 'bg-primary hover:bg-secondary text-white',
};

$widthClass = $fullWidth ? 'w-full' : '';
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => "$classes $widthClass rounded-lg py-3 px-5 font-medium
    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition"]) }}>
    {{ $slot }}
</button>
