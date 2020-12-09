<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $video->title }}
        </h2>
    </x-slot>
{{--    直リンクバージョン--}}
{{--    <video src="{{ asset($video_path) }}" controlsList="nodownload" oncontextmenu="return false;" preload="none" controls></video>--}}
    <video src="{{ route('protection', ['file_path' => $video->id]) }}" controlsList="nodownload" oncontextmenu="return false;" preload="none" controls></video>
    <p>やっぴ</p>
</x-app-layout>
