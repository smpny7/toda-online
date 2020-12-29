<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('コンソール画面') }}
        </h2>
    </x-slot>

    <div class="bg-repeat py-12" style="background-image: url({{ asset('img/home-background.png') }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.student') }}">生徒一覧</a>
            <a href="{{ route('admin.video') }}">映像一覧</a>
        </div>
    </div>
</x-app-layout>
