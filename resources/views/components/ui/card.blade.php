@props(['header' => null, 'footer' => null])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow overflow-hidden']) }}>
    @if ($header)
        <div class="px-4 py-3 border-b border-gray-200">
            {{ $header }}
        </div>
    @endif

    <div class="p-4">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
            {{ $footer }}
        </div>
    @endif
</div>
