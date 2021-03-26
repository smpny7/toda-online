<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ホーム') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-4 px-3 sm:px-0">
                <div class="col-span-4 sm:col-span-3 lg:col-span-2 relative">
                    <img class="w-10/12 rounded-full object-cover"
                         src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                    <p class="absolute bottom-0 sm:bottom-5 right-0 sm:right-4 bg-themeColor rounded-full px-3 py-1 text-white text-xs">
                        @if(Auth::user()->grade == 0)
                            {{ __('管理者') }}
                        @else
                            {{ __(Auth::user()->grade . '年生') }}
                        @endif
                    </p>
                </div>

                <div class="col-span-8 sm:col-span-4 lg:col-span-3 align-middle pt-4 sm:pt-8 xl:pt-10">
                    <p class="text-3xl tracking-widest font-bold">{{ __(Auth::user()->name . ' さん') }}</p>
                    <p class="text-sm text-gray-600"><span>視聴済み 22本</span><span class="ml-4">未視聴 148本</span></p>
                </div>

                <div class="col-span-12 sm:col-span-5 lg:col-span-4 pt-4 sm:pt-13">
                    <a href="{{ route('search') }}"
                       class="bg-white rounded-lg border-themeColor border-2 ml-3 sm:ml-0 px-5 md:px-2 xl:px-5 py-2">
                        <img class="inline-block w-6" src="{{ asset('img/search-button-icon.png') }}" alt="search">
                        <span class="text-themeColor font-bold tracking-widest ml-2">動画を検索</span>
                    </a>
                    <button
                        class="bg-themeColor rounded-lg border-themeColor border-2 ml-1 lg:ml-3 xl:ml-4 px-5 md:px-2 xl:px-5 py-2">
                        <img class="inline-block w-6" src="{{ asset('img/bookmark-button-icon.png') }}" alt="bookmark">
                        <span class="text-white font-bold tracking-widest ml-2">後で見る</span>
                    </button>
                </div>

                <div class="sm:col-span-3 hidden lg:block">
                    <img class="w-full object-cover" src="{{ asset('img/image.png') }}" alt="image"/>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-repeat py-12" style="background-image: url({{ asset('img/home-background.png') }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="font-semibold mx-7 sm:mx-0 text-2xl text-gray-800 leading-tight">
                {{ __('次に見る') }}
            </h3>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10 grid-rows-1 mx-7 sm:mx-auto">
                {{-- とりあえず先頭から3件 --}}
                @foreach($watch_next_videos as $video)
                    @include('components.video-card-old', ['video' => $video])
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
