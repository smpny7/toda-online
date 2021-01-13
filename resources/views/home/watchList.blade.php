<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ウォッチリスト') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4 sm:mt-8">
                @foreach($videos as $video)
                    @include('components.video-card', ['video' => $video, 'class_key' => $video->video->class_key, 'chapter_key' => $video->video->chapter_key, 'section_key' => $video->video->section_key])
                @endforeach
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("pageshow", function (event) {
            const historyTraversal = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
            if (historyTraversal) window.location.reload();
        });
    </script>
</x-app-layout>
