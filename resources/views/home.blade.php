<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ホーム') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('次に見る') }}
            </h3>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-dashboard />
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('受講中の講座一覧') }}
            </h3>
            {{-- <x-course-card/> --}}
            @foreach(config('const.CLASS') as $class)
                @include('components.course-card', ['class'=>$class])
            @endforeach
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('後で見る') }}
            </h3>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-dashboard />
            </div>
        </div>
    </div>
</x-app-layout>
