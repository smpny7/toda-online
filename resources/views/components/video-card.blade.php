<div class="bg-white col-span-1 mb-1 sm:mb-2 px-7 py-7 relative rounded-xl shadow-md">
    <div class="flex">
        <h3 class="flex-grow font-bold pl-2 text-gray-800 text-2xl tracking-wider">{{ $video->title }}</h3>
        <form class="h-7 ml-3 mt-1 relative w-7 watch_later" onchange="switchBookmark({{ $video->id }})"
              action="{{ route('switchBookmark', ['video_id' => $video->id]) }}" method="POST">
            <input id="bookmark_{{ $video->id }}" type="checkbox" class="absolute h-full opacity-0 w-full"
                   @if($video->isBookmarked()) checked @endif>
            <label for="bookmark_{{ $video->id }}" style="background-size: 1.75rem"
                   class="bg-bookmark selected-sibling:bg-bookmark-f bg-no-repeat bg-left-top h-full inline-block w-full"></label>
        </form>
    </div>
    <div class="ml-1 mt-5">
        <img src="{{ $video->getThumbnailPath() }}" class="rounded-xl shadow-xl" alt="{{ $video->title }}">
    </div>
    <a class="@if($video->isWatched()) bg-gray-200 @else bg-themeColor @endif font-bold h-11 inline-block mt-7 pt-3 rounded-lg shadow-md text-center text-sm text-white transition duration-500 transform hover:scale-102 tracking-widest w-full"
       href="{{ route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video->video_id]) }}">視聴</a>
</div>
