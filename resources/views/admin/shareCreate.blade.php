<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.createShareLink', ['video_id' => $video->id]) }}" method="POST">
                @csrf
                <label class="block">
                    開始日
                    <input name="start" type="datetime-local" required>
                </label>
                <label class="block">
                    終了日
                    <input name="end" type="datetime-local" required>
                </label>
                <button class="block text-themeColor" type="submit">作成</button>
            </form>
            @isset($url)
                <div class="mt-4">
                    <p>
                        <span class="mr-2">今回発行されたURL:</span>
                        <a href="{{ route('share', ['id' => $url]) }}" target="_blank" rel="noopener noreferrer"
                           class="text-themeColor">{{ route('share', ['id' => $url]) }}</a>
                    </p>
                    <a href="{{ route('admin.video') }}" class="text-themeColor">戻る</a>
                </div>
            @endisset
        </div>
    </div>
</x-app-layout>
