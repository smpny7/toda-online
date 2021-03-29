<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.createShareLink', ['video_id' => $video->id]) }}" method="POST">
                @csrf
                <label>
                    任意の共有名
                    <input name="title" type="text" class="border border-themeColor" required>
                </label>
                <label class="block">
                    開始日
                    <input name="start" type="datetime-local" value="{{ str_replace(" ", "T", (new DateTime('now'))->format('Y-m-d H:i')) }}"
                           class="border border-themeColor" required>
                </label>
                <label class="block">
                    終了日
                    <input name="end" type="datetime-local" class="border border-themeColor"
                           value="{{ str_replace(" ", "T", (new DateTime('now'))->modify('+1 weeks')->format('Y-m-d H:i')) }}" required>
                </label>
                <button class="block text-themeColor" type="submit">作成</button>
            </form>
            @isset($url)
                <div class="mt-4">
                    <p>
                        <span class="mr-2">今回発行されたURL:</span>
                        <a href="{{ route('share.show', ['id' => $url]) }}" target="_blank" rel="noopener noreferrer"
                           class="text-themeColor">{{ route('share.show', ['id' => $url]) }}</a>
                    </p>
                    <a href="{{ route('admin.video') }}" class="text-themeColor">戻る</a>
                </div>
            @endisset
        </div>
    </div>
</x-app-layout>
