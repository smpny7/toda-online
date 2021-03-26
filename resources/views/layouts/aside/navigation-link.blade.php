<li class="my-px">
    <a href="{{ $link }}" class="flex flex-row items-center h-12 px-4 rounded-lg
            @if($active) bg-gray-100 text-gray-600 @else hover:bg-gray-700 text-gray-500 @endif">
        <span class="flex items-center justify-center text-lg {{ $icon_color }}">{!! $icon !!}</span>
        <span class="ml-3">{{ $label }}</span>
        @isset($badge)
            <span class="flex items-center justify-center text-sm text-orange-500 font-semibold bg-orange-300 h-6 px-2 rounded-full ml-auto">{{ $badge }}</span>
        @endisset
    </a>
</li>