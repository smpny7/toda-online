<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $videos[0]['section'] }}
        </h2>
    </x-slot>
    @foreach($videos as $video)
        <a href="{{ route('show', ['class_key' => $class_key, 'chapter_key' => $chapter_key, 'section_key' => $section_key, 'video_id' => $video['video_id']]) }}">{{ $video['title'] }}</a>
    @endforeach
</x-app-layout>
