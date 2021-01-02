<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $video->title }}
        </h2>
    </x-slot>
    <video src="{{ route('protection', ['video_id' => $video->id]) }}" controlsList="nodownload" oncontextmenu="return false;" preload="none" controls></video>
    <p>やっぴ</p>
</x-app-layout>
