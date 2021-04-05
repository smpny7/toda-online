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
                <div class="w-full xl:w-2/3">
                    <h1 class="font-bold text-2xl text-gray-700 tracking-widest">お知らせ</h1>
                    @for($i=0;$i<4;$i++)
                        <div class="mt-6">
                            <div class="px-10 py-6 bg-white shadow-xl rounded-2xl">
                                <div class="flex justify-between items-center">
                                    <span class="font-light text-gray-600 tracking-widest">2021/3/2</span>
                                    <span
                                        class="px-2 py-1 bg-themeColor text-white font-bold text-sm rounded">メンテナンス</span>
                                </div>
                                <div class="mt-2">
                                    <a href="#" class="text-2xl text-gray-700 font-bold hover:underline">2021年3月12日のメンテナンスについて</a>
                                    <p class="mt-2 text-gray-600">
                                        Lorem ipsum dolor sit, amet consectetur
                                        adipisicing elit.
                                        Tempora expedita dicta totam aspernatur doloremque. Excepturi iste iusto eos
                                        enim
                                        reprehenderit nisi, accusamus delectus nihil quis facere in modi ratione
                                        libero!
                                    </p>
                                </div>
                                <div class="text-right mt-4">
                                    <a href="#">
                                        <img src="{{ asset('img/logo.png') }}" alt="avatar"
                                             class="mx-2 w-10 h-10 object-cover rounded-full inline">
                                        <h1 class="inline text-gray-700 font-semibold hover:underline">戸田塾オンライン</h1>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="mt-8">
                        <div class="flex">
                            <a href="#"
                               class="mx-1 px-3 py-2 bg-white text-gray-500 font-medium rounded-md cursor-not-allowed">
                                previous
                            </a>

                            <a href="#"
                               class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                                1
                            </a>

                            <a href="#"
                               class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                                2
                            </a>

                            <a href="#"
                               class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                                3
                            </a>

                            <a href="#"
                               class="mx-1 px-3 py-2 bg-white text-gray-700 font-medium hover:bg-blue-500 hover:text-white rounded-md">
                                Next
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-16 xl:mt-0 xl:-ml-10 w-full xl:w-1/3">
                    <div class="xl:pl-10">
                        <h1 class="font-bold text-2xl text-gray-700 tracking-widest">あとで見る</h1>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-1 gap-6">
                            @foreach($videos as $video)
                                <a href="{{ route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video->video_id]) }}"
                                   class="block w-full mt-6 mx-auto shadow-xl rounded-2xl overflow-hidden">
                                    <div class="flex items-end justify-end h-48 w-full bg-cover bg-center"
                                         style="background-image: url({{ $video->getThumbnailPath() }})">
                                        <button
                                            class="p-3 rounded-full bg-themeColor text-white mx-5 -mb-4 focus:outline-none transition duration-500 transform hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" fill="white"
                                                 width="16" height="16" viewBox="0 0 163.861 163.861">
                                                <path
                                                    d="M34.857,3.613C20.084-4.861,8.107,2.081,8.107,19.106v125.637c0,17.042,11.977,23.975,26.75,15.509L144.67,97.275 c14.778-8.477,14.778-22.211,0-30.686L34.857,3.613z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="px-5 py-3">
                                        <h3 class="text-gray-700 uppercase">{{ $video->section . ' ' . $video->title }}</h3>
                                        <span class="text-gray-500 text-sm mt-2">{{ $video->getVideoDuration() }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
