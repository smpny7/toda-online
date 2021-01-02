<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $videos[0]['class'] }}
        </h2>
    </x-slot>
    @foreach($videos as $video)
        <a href="{{ route('chapter', ['class_key' => $class_key, 'chapter_key' => $video['chapter_key']]) }}">{{ $video['chapter'] }}</a>
    @endforeach
</x-app-layout>
