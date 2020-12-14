<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ホーム') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                <img class="h-16 w-16 rounded-full object-cover"
                     src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
            </div>
            <p>
                @if(Auth::user()->grade > 0)
                    {{ __(Auth::user()->grade . '年生') }}
                @else
                    {{ __('管理者') }}
                @endif
            </p>
            <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __(Auth::user()->name . ' さん') }}
            </h3>
        </div>
    </div>

    <div class="bg-repeat py-12" style="background-image: url({{ asset('img/home-background.png') }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('次に見る') }}
            </h3>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10 grid-rows-1 mt-4 mx-7 sm:mx-auto">
                {{-- とりあえず先頭から3件 --}}
                @foreach($watch_next_videos as $video)
                    @include('components.video-card', ['video' => $video])
                @endforeach
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
</x-app-layout>
