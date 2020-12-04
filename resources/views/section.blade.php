<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $section }}
        </h2>
    </x-slot>
    @foreach($videos as $video)
        <a href="{{ route('video', ['video_id' => $video->id]) }}">{{ $video->title }}</a>
    @endforeach
</x-app-layout>
