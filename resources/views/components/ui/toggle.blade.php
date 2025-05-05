@props(['checked' => false])

<div x-data="{ checked: {{ $checked ? 'true' : 'false' }} }">
    <button type="button" x-on:click="checked = !checked" {{ $attributes->merge(['class' => 'relative inline-flex h-6
        w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200
        ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2']) }}
        :class="checked ? 'bg-primary' : 'bg-gray-200'"
        role="switch"
        aria-checked="false">
        <span class="sr-only">Toggle</span>
        <span
            class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
            :class="checked ? 'translate-x-5' : 'translate-x-0'">
        </span>
    </button>
</div>
