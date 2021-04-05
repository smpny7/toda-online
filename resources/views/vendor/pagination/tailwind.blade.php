@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="mx-1 px-3 py-2 bg-white text-gray-500 font-medium rounded-md">
                    <
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-themeColor hover:text-white rounded-md">
                    <
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="mx-1 px-3 py-2 bg-white text-gray-500 font-medium rounded-md">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="mx-1 px-3 py-2 bg-white text-gray-500 font-medium rounded-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-themeColor hover:text-white rounded-md">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-themeColor hover:text-white rounded-md">
                    >
                </a>
            @else
                <span class="mx-1 px-3 py-2 bg-white text-gray-500 font-medium rounded-md">
                    >
                </span>
            @endif
        </div>
    </nav>
@endif
