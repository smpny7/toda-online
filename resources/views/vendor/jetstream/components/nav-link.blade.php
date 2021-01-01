@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 text-sm font-medium leading-5 relative text-themeColor focus:outline-none transition duration-150 ease-in-out nav-link-after'
                : 'inline-flex items-center px-1 text-sm font-medium leading-5 relative text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out nav-link-hover';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
