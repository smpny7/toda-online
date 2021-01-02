<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $videos[0]['chapter'] }}
        </h2>
    </x-slot>
    @foreach($videos as $video)
        <a href="{{ route('section', ['class_key' => $class_key, 'chapter_key' => $chapter_key, 'section_key' => $video['section_key']]) }}">{{ $video['section'] }}</a>
    @endforeach
</x-app-layout>
