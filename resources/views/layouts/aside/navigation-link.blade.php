<li class="my-0.5">
    <a href="{{ $link }}" class="flex flex-row items-center h-12 px-4 rounded-2xl
            @if($active) bg-gray-100 text-gray-600 @else hover:bg-gray-700 text-gray-500 @endif"
                @isset($logout) onclick="event.preventDefault(); document.getElementById('logout-form').submit()" @endisset>
        <span class="flex items-center justify-center text-lg {{ $icon_color }}">{!! $icon !!}</span>
        <span class="ml-3">{{ $label }}</span>
        @isset($badge)
            <span class="flex items-center justify-center text-sm text-orange-500 font-semibold bg-orange-300 h-6 px-2 rounded-full ml-auto">{{ $badge }}</span>
        @endisset
    </a>
</li>
