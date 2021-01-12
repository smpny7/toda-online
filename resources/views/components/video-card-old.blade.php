<div>
    <a href="{{ route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video->video_id]) }}"
       class="transition duration-500 block ease-in-out mt-4 mx-auto relative transform hover:scale-102">
        <img class="border-2 border-themeColor rounded-lg" src="{{ $video->thumbnail }}" alt="{{ $video->title }}">
        <p class="absolute bg-themeColor rounded-full font-bold px-3 py-0.5 text-white text-xs bottom-2 right-2">
            @isset($video->duration) {{ TimeConversion::fromSecondsToMinutes($video->duration) }} @endisset
        </p>
    </a>
    <div class="flex">
        <div class="flex-grow mt-3 ml-3">
            <div class="overflow-hidden">
                <h3 class="font-bold text-gray-800 text-lg tracking-widest overflow-hidden truncate whitespace-nowrap">{{ $video->title }}</h3>
            </div>
            <div class="mt-1 overflow-hidden">
                <p class="text-gray-600 text-sm tracking-widest overflow-hidden truncate whitespace-nowrap">
                    {{ $video->class }} - {{ $video->chapter }} - {{ $video->section }}
                </p>
            </div>
        </div>
        <a href="{{ route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video->video_id]) }}"
           class="transition duration-500 block flex-none text-right mt-2 p-3 w-16 transform hover:scale-110">
            <img src="{{ asset('img/play-button.png') }}" alt="PlayButton">
        </a>
    </div>
</div>
