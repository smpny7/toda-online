<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8">
            <h1 class="font-bold text-2xl text-gray-700 tracking-widest mb-4">{{ isset($keyword) ? $keyword . ' の検索結果' : '講義を検索' }}</h1>

            <form action="{{ route('search') }}" class="relative" method="GET">
                <input type="text" name="keyword" placeholder="キーワードを入力"
                       class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-themeColor transition-colors">
                <button type="submit"
                    class="block w-7 h-7 text-center text-xl leading-0 absolute top-2 right-2 text-gray-400 focus:outline-none hover:text-gray-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#a1a1a1" viewBox="-2.5 -2.5 24 24" width="24" height="24" preserveAspectRatio="xMinYMin" class="icon__icon"><path d="M8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12zm6.32-1.094l3.58 3.58a1 1 0 1 1-1.415 1.413l-3.58-3.58a8 8 0 1 1 1.414-1.414z"></path></svg>
                </button>
            </form>

            @if($videos->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-2 sm:mt-6">
                    @foreach($videos as $video)
                        @include('components.video-card', ['video' => $video])
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 mt-6">別のキーワードで検索してみてください</p>
            @endif
        </div>
    </div>
</x-app-layout>
