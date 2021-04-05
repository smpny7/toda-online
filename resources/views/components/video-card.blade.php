<a href="{{ route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video->video_id]) }}"
   class="block w-full mt-6 mx-auto shadow-lg rounded-2xl overflow-hidden transition duration-500 transform hover:shadow-xl">
    <div class="flex items-end justify-end h-48 w-full bg-cover bg-center"
         style="background-image: url({{ $video->getThumbnailPath() }})">
        <button
            class="p-3 rounded-full bg-themeColor text-white mx-5 -mb-4 focus:outline-none transition duration-500 transform hover:scale-105 hover:shadow">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" fill="white"
                 width="16" height="16" viewBox="0 0 163.861 163.861">
                <path
                    d="M34.857,3.613C20.084-4.861,8.107,2.081,8.107,19.106v125.637c0,17.042,11.977,23.975,26.75,15.509L144.67,97.275 c14.778-8.477,14.778-22.211,0-30.686L34.857,3.613z"/>
            </svg>
        </button>
    </div>
    <div class="px-5 py-3">
        <h3 class="text-gray-700 uppercase">{{ $video->section . ' ' . $video->title }}</h3>
        <span
            class="text-gray-500 text-sm mt-2">{{ $video->getVideoDuration() }}</span>
    </div>
</a>
