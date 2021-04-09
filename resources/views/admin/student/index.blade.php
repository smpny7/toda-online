<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            @include('components.breadcrumbs', [
                'first_link' => route('admin.index'),
                'first_label' => '管理者ページ',
                'last_link' => route('admin.student.index'),
                'last_label' => '受講生一覧'
            ])

            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">氏名</th>
                            <th class="py-3 px-6 text-left">学年</th>
                            <th class="py-3 px-6 text-left hidden md:table-cell">登録日</th>
                            <th class="py-3 px-6 text-left hidden sm:table-cell">最終ログイン日</th>
                            <th class="py-3 px-6 text-center">その他</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach($students as $student)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>{{ $student->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>{{ $student->grade ? $student->grade . '年生' : '管理者' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap hidden md:table-cell">
                                    <div class="flex items-center">
                                        <span>{{ $student->created_at->format('Y/m/d') }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap hidden sm:table-cell">
                                    <div class="flex items-center">
                                        <span>{{ $student->updated_at->format('Y/m/d h:i') }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="{{ route('admin.student.show', ['student' => $student->id]) }}" class="block w-4 mr-2 transform hover:text-themeColor hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.student.edit', ['student' => $student->id]) }}" class="block w-4 mr-2 transform hover:text-themeColor hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </a>
                                        <a class="block cursor-not-allowed w-4 mr-2 transform hover:text-themeColor hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
