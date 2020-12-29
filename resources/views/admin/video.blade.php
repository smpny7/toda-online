<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('映像一覧') }}
        </h2>
    </x-slot>

    <div class="bg-repeat py-12" style="background-image: url({{ asset('img/home-background.png') }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($videos as $video)
                <li>{{ $video->class . ' ' . $video->chapter . ' ' . $video->title }}</li>
            @endforeach
        </div>
    </div>
</x-app-layout>
