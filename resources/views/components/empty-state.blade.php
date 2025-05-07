<div {{ $attributes->merge(['class' => 'py-12 flex flex-col items-center justify-center text-gray-500']) }}>
    @if($icon === 'document')
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
    @elseif($icon === 'calendar')
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    @elseif($icon === 'search')
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    @elseif($icon === 'car')
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 16v3a2 2 0 01-2 2H7a2 2 0 01-2-2v-3m14-8v5a2 2 0 01-2 2H7a2 2 0 01-2-2V8m14-3l-5-3-5 3" />
        </svg>
    @endif

    <span>{{ $message }}</span>

    @if($actionText && $actionUrl)
        <a href="{{ $actionUrl }}" class="mt-3 text-sm text-yellow-600 hover:text-yellow-700 font-medium">
            {{ $actionText }}
        </a>
    @endif

    {{ $slot }}
</div>