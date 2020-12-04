<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $chapter }}
        </h2>
    </x-slot>
    @foreach($sections as $section)
        <a href="{{ route('section', ['section' => $section['section']]) }}">{{ $section['section'] }}</a>
    @endforeach
</x-app-layout>
