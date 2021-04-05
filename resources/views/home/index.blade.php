<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="container mx-auto">
                <h1 class="font-bold text-2xl text-gray-700 tracking-widest mb-10 mt-12">受講中の講座</h1>
                <div class="grid md:grid-cols-2 2xl:grid-cols-3 gap-8">
                    @foreach(config('const.CLASS') as $class_key => $class)
                        @if($attendance->$class_key)
                            <div class="flex items-center flex-wrap mb-3 px-10 bg-white shadow-xl rounded-2xl h-24">
                                <div
                                    class="flex items-center justify-center -m-6 overflow-hidden bg-white rounded-full">
                                    <svg class="w-32 h-32 transform translate-x-1 translate-y-1" aria-hidden="true">
                                        <circle
                                            class="text-gray-300"
                                            stroke-width="10"
                                            stroke="currentColor"
                                            fill="transparent"
                                            r="50"
                                            cx="60"
                                            cy="60"
                                        />
                                        <circle
                                            class="text-themeColor"
                                            stroke-width="10"
                                            stroke-dasharray="314.159"
                                            stroke-dashoffset="{{ (100 - $classes[$loop->index]) * 3.14159 }}"
                                            stroke-linecap="round"
                                            stroke="currentColor"
                                            transform="rotate(-90) translate(-120 0)"
                                            fill="transparent"
                                            r="50"
                                            cx="60"
                                            cy="60"
                                        />
                                    </svg>
                                    <span
                                        class="absolute text-2xl {{ $classes[$loop->index] ? 'text-themeColor' : 'text-gray-300' }}">{{ $classes[$loop->index] }}%</span>
                                </div>
                                <p class="ml-10 font-medium text-gray-600 tracking-wide sm:text-xl">{{ $class }}</p>
                                <span
                                    class="ml-auto text-md tracking-wider text-themeColor">受講中</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="xl:flex justify-between container mt-20 mx-auto">
                @if($notices->count())
                    <div class="w-full @if($videos->count()) xl:w-2/3 @endif">
                        <h1 class="font-bold text-2xl text-gray-700 tracking-widest">お知らせ</h1>
                        @foreach($notices as $notice)
                            <div class="mt-6">
                                <div class="px-10 py-6 bg-white shadow-xl rounded-2xl">
                                    <div class="flex justify-between items-center">
                                        <span
                                            class="font-light text-gray-600 tracking-widest">{{ $notice->updated_at->format('Y/m/d') }}</span>
                                        <span
                                            class="px-2 py-1 bg-themeColor text-white font-bold text-sm rounded">{{ $notice->genre }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <span
                                            class="text-2xl text-gray-700 font-bold hover:underline">{{ $notice->title }}</span>
                                        <p class="mt-2 text-gray-600">
                                            {{ $notice->content }}
                                        </p>
                                    </div>
                                    <div class="text-right mt-4">
                                        <div>
                                            <img src="{{ asset('img/logo.png') }}" alt="avatar"
                                                 class="mx-2 w-10 h-10 object-cover rounded-full inline">
                                            <h1 class="inline text-gray-700 font-semibold hover:underline">戸田塾オンライン</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-8">
                            {{ $notices->links() }}
                        </div>
                    </div>
                @endif

                @if($videos->count())
                    <div class="mt-16 xl:mt-0 xl:-ml-10 w-full @if($notices->count()) xl:w-1/3 @endif">
                        <div class="xl:pl-10">
                            <h1 class="font-bold text-2xl text-gray-700 tracking-widest">あとで見る</h1>
                            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-1 gap-6">
                                @foreach($videos as $video)
                                    @include('components.video-card', ['video' => $video])
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
