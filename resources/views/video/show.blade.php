<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $video->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-6 mt-3">
                <div class="col-span-3 lg:col-span-2">
                    <video src="{{ route('protection', ['video_id' => $video->id]) }}"
                           controlsList="nodownload" controls oncontextmenu="return false" preload="none"
                           class="rounded-xl shadow-xl w-full focus:outline-none"
                           poster="{{ Storage::disk('local')->url('thumbnail/' . $video->id . '.jpg') }}"></video>
                    <div class="bg-white grid grid-cols-12 mt-7 px-1 py-6 rounded-xl shadow-md">
                        <div class="col-span-2">
                            <p class="pt-1 text-center">
                                <span
                                    class="bg-themeColor font-semibold px-4 py-1 rounded-xl text-white tracking-widest">
                                    {{ $video->class }}
                                </span>
                            </p>
                        </div>
                        <div class="col-span-9">
                            <h3 class="font-bold pl-3 text-2xl tracking-widest">{{ $video->title }}</h3>
                            <div class="mt-3 pl-3">
                                <img src="{{ asset('img/file.png') }}" class="align-middle inline-block w-5" alt="File">
                                <span
                                    class="align-middle font-semibold inline-block ml-2 text-gray-500 text-md">25MB</span>
                                <img src="{{ asset('img/clock.png') }}" class="align-middle inline-block ml-5 w-5"
                                     alt="Clock">
                                <span
                                    class="align-middle font-semibold inline-block ml-2 text-gray-500 text-md">04:23</span>
                                <img
                                    src="@if(false) {{ asset('img/eye.png') }} @else {{ asset('img/eye-off.png') }} @endif"
                                    class="align-middle inline-block ml-5 w-5" alt="Eye-Off">
                                <span
                                    class="align-middle font-semibold inline-block ml-2 text-gray-500 text-sm">@if(false)
                                        視聴済み @else 未視聴 @endif</span>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <form class="h-1/2 ml-3 relative w-1/2 watch_later">
                                <input id="bookmark" type="checkbox" class="absolute h-full opacity-0 w-full"
                                       @if(false) selected @endif>
                                <label for="bookmark" style="background-size: 30px"
                                       class="bg-bookmark selected-sibling:bg-bookmark-f bg-no-repeat bg-left-top h-full inline-block w-full"></label>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-white col-span-3 lg:col-span-1 h-150 relative rounded-xl shadow-md">
                    <div class="absolute bg-white border-b-2 border-gray-200 h-16 rounded-t-xl top-0 w-full z-10">
                        <span class="inline-block ml-7 mt-5 tracking-widest text-lg">コミュニティ</span>
                    </div>
                    <div id="message" class="h-120 mt-16 overflow-y-scroll py-3 relative">
                        @for($i=1; $i<=7; $i++)
                            <div class="flex mb-3">
                                <img src="{{ $users->find(11)->profile_photo_url }}"
                                     class="flex-none h-12 ml-3 rounded-full w-12" alt="Icon">
                                <div class="flex-grow pl-4 pr-2">
                                    <p>
                                        <span class="text-gray-500 text-xs tracking-widest">{{ $users->find(11)->name }}</span>
                                        <span class="pl-2 text-gray-500 text-xxs tracking-wide">12/24 12:24</span>
                                    </p>
                                    <p class="text-sm">@for($j=0; $j<$i; $j++)あああああああああああああ@endfor</p>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="absolute bottom-0 bg-white h-16 rounded-b-xl w-full z-10">
                        <form action="#" class="mt-3 relative">
                            <input type="text" placeholder="メッセージを送信"
                                   class="absolute bg-gray-100 h-10 left-0 m-auto pl-5 pr-10 right-0 rounded-xl text-gray-600 text-sm w-11/12 focus:outline-none">
                            <button type="submit" class="absolute right-3 top-3 focus:outline-none">
                                <img src="{{ asset('img/send.png') }}" class="w-1/2" alt="Send">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('#message').animate({scrollTop: $('#message')[0].scrollHeight}, 'fast');
        });
    </script>
</x-app-layout>
