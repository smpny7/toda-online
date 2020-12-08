<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $video->title }}
        </h2>
    </x-slot>
    <video src="{{ asset($video->path) }}" controlsList="nodownload" oncontextmenu="return false;" preload="none" controls></video>
    <p>やっぴ</p>
    {{ var_dump(exec('which ffmpeg')) }}
</x-app-layout>
