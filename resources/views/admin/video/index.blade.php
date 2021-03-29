{{--<x-app-layout>--}}
{{--    <div class="bg-repeat py-12" style="background-image: url({{ asset('img/home-background.png') }})">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <table>--}}
{{--                @foreach($videos as $video)--}}
{{--                    <tr>--}}
{{--                        <td class="pr-12">{{ $video->class }}</td>--}}
{{--                        <td>{{ $video->chapter }}</td>--}}
{{--                        <td class="pr-4">{{ $video->title }}</td>--}}
{{--                        <td class="pr-4">--}}
{{--                            <a href="{{ route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video->video_id]) }}"--}}
{{--                               class="text-themeColor">見る</a></td>--}}
{{--                        <td><a href="{{ route('admin.share.create', ['video_id' => $video->id]) }}" class="text-themeColor">共有リンク生成</a></td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}

<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            @include('components.breadcrumbs', [
                'first_link' => route('admin.index'),
                'first_label' => '管理者ページ',
                'last_link' => route('admin.video'),
                'last_label' => '映像一覧'
            ])

            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left hidden lg:table-cell">教科</th>
                        <th class="py-3 px-6 text-left hidden md:table-cell">章</th>
                        <th class="py-3 px-6 text-left">節</th>
                        <th class="py-3 px-6 text-left">タイトル</th>
                        <th class="py-3 px-6 text-center hidden sm:table-cell">状態</th>
                        <th class="py-3 px-6 text-center">その他</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($videos as $video)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap hidden lg:table-cell">
                                <div class="flex items-center">
                                    <span>{{ $video->class }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap hidden md:table-cell">
                                <div class="flex items-center">
                                    <span>{{ $video->chapter }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span>{{ $video->section }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span>{{ $video->title }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center hidden sm:table-cell">
                                @if($video->active)
                                    <span
                                        class="bg-orange-400 font-bold text-white py-1 px-3 rounded-full text-xs">表示中</span>
                                @else
                                    <span
                                        class="bg-gray-400 font-bold text-white py-1 px-3 rounded-full text-xs">非表示中</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('show', ['class_key' => $video->class_key, 'chapter_key' => $video->chapter_key, 'section_key' => $video->section_key, 'video_id' => $video->video_id]) }}"
                                       target="_blank" rel="noopener noreferrer"
                                       class="block w-4 mr-2 transform hover:text-themeColor hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.share.create', ['video_id' => $video->id]) }}"
                                        class="block w-4 mr-2 transform hover:text-themeColor hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="-2 -2 24 24">
                                            <path d="M7.928 9.24a4.02 4.02 0 0 1-.026 1.644l5.04 2.537a4 4 0 1 1-.867 1.803l-5.09-2.562a4 4 0 1 1 .083-5.228l5.036-2.522a4 4 0 1 1 .929 1.772L7.928 9.24z"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
