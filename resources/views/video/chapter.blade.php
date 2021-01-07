<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $videos->first()->chapter }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mb-8 mx-auto px-8">
            @empty(!$explanation->data)
                <div class="bg-white flex mb-6 sm:mb-12 mt-4 sm:mt-8 px-8 sm:px-16 py-8 rounded-lg shadow-md">
                    <div class="flex-grow">
                        <p class="font-bold text-3xl tracking-widest">{{ $videos->first()->chapter }}</p>
                        <p class="leading-7 md:mr-10 mt-3 text-gray-500">{{ $explanation->data }}</p>
                    </div>
                    <div class="flex-none hidden md:block w-60">
                        <img src="{{ asset('img/studying.png') }}" alt="Studying">
                    </div>
                </div>
            @endempty
            @foreach($videos as $video)
                <div class="bg-white md:flex mt-4 px-5 sm:px-10 py-4 rounded-lg shadow-md">
                    <div class="flex-grow inline-block">
                        <p class="font-bold pt-1 text-xl tracking-widest">{{ $video->section }}</p>
                    </div>
                    <div class="flex flex-none flex-row float-right">
                        <div class="hidden md:block mr-6 pt-4 relative">
                            <div class="bg-gray-200 h-1 rounded w-56"></div>
                            <div class="absolute bg-themeColor h-1 rounded top-4"
                                 style="width: {{ $video->watched * 100 / $video->all}}%"></div>
                        </div>
                        <p class="font-bold inline-block mr-5 md:mr-10 pt-1 text-lg text-right text-themeColor tracking-widest w-10">
                            {{ sprintf("%2d", $video->watched) }}/{{ sprintf("%2d", $video->all) }}
                        </p>
                    </div>
                    <div class="md:flex md:flex-none md:flex-row h-9 mt-3 md:mt-0">
                        <a class="bg-themeColor order-2 font-bold float-right h-9 inline-block pt-2 rounded-lg shadow-md text-center text-sm text-white tracking-widest w-24"
                           href="{{ route('section', ['class_key' => $class_key, 'chapter_key' => $chapter_key, 'section_key' => $video['section_key']]) }}">選択</a>
                        <img
                            src="@if($video->watched == $video->all) {{ asset('img/award-on.png') }} @else {{ asset('img/award-off.png') }} @endif"
                            class="float-right order-1 h-7 mr-3 md:mr-6 mt-1 w-7" alt="Award">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        window.addEventListener( "pageshow", function ( event ) {
            const historyTraversal = event.persisted ||
                ( typeof window.performance != "undefined" &&
                    window.performance.navigation.type === 2 );
            if ( historyTraversal ) {
                window.location.reload();
            }
        });
    </script>
</x-app-layout>
