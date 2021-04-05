<x-app-layout>
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="container mx-auto">
                <div class="w-full">
                    <h1 class="font-bold text-2xl text-gray-700 tracking-widest">お知らせ一覧</h1>
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
                </div>
            </div>
        </div>
</x-app-layout>
