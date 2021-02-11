<div class="bg-white col-span-1 mb-1 sm:mb-2 px-7 py-7 relative rounded-xl shadow-md">
    <div class="flex">
        <h3 class="flex-grow font-bold pl-2 text-gray-800 text-2xl tracking-wider">{{ $video->title }}</h3>
        <img
            src="@if($video->bookmark) {{ asset('img/bookmark-f.png') }} @else {{ asset('img/bookmark.png') }} @endif"
            class="flex-none h-6 mt-1 w-6" alt="Bookmark">
    </div>
    <div class="ml-1 mt-5">
        <img src="{{ $video->thumbnail }}" class="rounded-xl shadow-xl" alt="{{ $video->title }}">
    </div>
    <a class="@if($video->history) bg-gray-200 @else bg-themeColor @endif font-bold h-11 inline-block mt-7 pt-3 rounded-lg shadow-md text-center text-sm text-white transition duration-500 transform hover:scale-102 tracking-widest w-full"
       href="{{ route('show', ['class_key' => $class_key, 'chapter_key' => $chapter_key, 'section_key' => $section_key, 'video_id' => $video->video_id]) }}">視聴</a>
</div>
