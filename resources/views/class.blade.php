<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $class }}
        </h2>
    </x-slot>
    @foreach($chapters as $chapter)
        <a href="{{ route('chapter', ['chapter' => $chapter['chapter']]) }}">{{ $chapter['chapter'] }}</a>
    @endforeach
</x-app-layout>
