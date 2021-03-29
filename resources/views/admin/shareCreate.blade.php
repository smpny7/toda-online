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
        </div>
    </div>
</x-app-layout>
