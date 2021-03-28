<x-app-layout>
    <div class="bg-repeat py-12" style="background-image: url({{ asset('img/home-background.png') }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table>
                @foreach($videos as $video)
                    <tr>
                        <td class="pr-12">{{ $video->class }}</td>
                        <td>{{ $video->chapter }}</td>
                        <td class="pr-4">{{ $video->title }}</td>
                        <td class="pr-4">
                            <a href="{{ route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video->video_id]) }}"
                               class="text-themeColor">見る</a></td>
                        <td><a href="{{ route('admin.share.create', ['video_id' => $video->id]) }}" class="text-themeColor">共有リンク生成</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
