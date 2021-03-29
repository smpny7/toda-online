<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            @include('components.breadcrumbs', [
                'first_link' => route('admin.index'),
                'first_label' => '管理者ページ',
                'last_link' => route('admin.share.index'),
                'last_label' => '共有一覧'
            ])

            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">タイトル</th>
                        <th class="py-3 px-6 text-left hidden sm:table-cell">講座名</th>
                        <th class="py-3 px-6 text-left hidden lg:table-cell">リンク</th>
                        <th class="py-3 px-6 text-center">状態</th>
                        <th class="py-3 px-6 text-center">その他</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($shares as $share)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ $share->title }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left hidden sm:table-cell">
                                <div class="flex items-center">
                                    <span class="mr-3">{{ $share->video->section }}</span>
                                    <span>{{ $share->video->title }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left hidden lg:table-cell">
                                <div class="flex items-center">
                                    <a target="_blank" rel="noopener noreferrer"
                                       @if(new DateTime($share->started_at) > new DateTime('now') || new DateTime($share->ended_at) < new DateTime('now') )
                                       class="text-gray-400"
                                       @else
                                       href="{{ route('share.show', ['id' => $share->url]) }}" class="text-themeColor"
                                        @endif>{{ substr(route('share.show', ['id' => $share->url]), 0, 35) . '...' }}</a>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if(new DateTime($share->started_at) > new DateTime('now') || new DateTime($share->ended_at) < new DateTime('now'))
                                    <span
                                        class="bg-gray-400 inline-block sm:inline font-bold text-white py-1 px-1 sm:px-3 rounded-full text-xs">
                                        <span class="hidden sm:inline">無効</span>
                                    </span>
                                @else
                                    <span
                                        class="bg-orange-400 inline-block sm:inline font-bold text-white py-1 px-1 sm:px-3 rounded-full text-xs">
                                        <span class="hidden sm:inline">有効</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('share.show', ['id' => $share->url]) }}"
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
                                    <div class="w-4 mr-2 transform hover:text-themeColor hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </div>
                                    <a class="block w-4 mr-2 transform hover:text-themeColor hover:scale-110"
                                       onclick="event.preventDefault(); document.getElementById('delete-form').submit()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </a>
                                    <form id="delete-form" class="hidden"
                                          action="{{ route('admin.share.delete', ['id' => $share->id]) }}"
                                          method="POST">
                                        @csrf
                                    </form>
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
