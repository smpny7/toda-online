<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @isset($videos->first()->class) {{ $videos->first()->class }} @else 該当教科の動画が登録されていません @endif
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4 sm:mt-8">
                @foreach($videos as $video)
                    <div class="bg-white col-span-1 h-72 mb-1 sm:mb-2 px-5 py-5 relative rounded-xl shadow-md">
                        <div>
                            <h3 class="font-bold inline-block pl-2 text-gray-800 text-2xl tracking-wider">{{ $video->chapter }}</h3>
                            <p class="font-bold float-right text-themeColor text-2xl">{{ $video->watched }}%</p>
                        </div>
                        <div class="inline-block ml-1 mt-3">
                            @foreach($video->subtitles as $subtitle)
                                <li class="list-none text-sm text-gray-500 tracking-wider">
                                    <span class="font-bold mr-1">・</span>
                                    <span>{{ $subtitle->section }}</span>
                                </li>
                            @endforeach
                        </div>
                        <img src="@if($video->watched == 100) {{ asset('img/award-on.png') }} @else {{ asset('img/award-off.png') }} @endif" class="float-right mt-3 w-7" alt="Award">
                        <a class="absolute bottom-5 bg-themeColor font-bold h-10 inline-block pt-2 left-0 mx-auto rounded-lg right-0 shadow-md text-center text-sm text-white tracking-widest w-5/6"
                           href="{{ route('chapter', ['class_key' => $class_key, 'chapter_key' => $video->chapter_key]) }}">受講</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
