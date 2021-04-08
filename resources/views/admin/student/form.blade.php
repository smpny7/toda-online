<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @include('components.breadcrumbs', [
                'first_link' => route('admin.index'),
                'first_label' => '管理者ページ',
                'second_link' => route('admin.student.index'),
                'second_label' => '受講生一覧',
                'last_link' => route('admin.student.show', ['student' => $student->id]),
                'last_label' => $student->name
            ])

            <div class="border w-full relative flex flex-col mx-auto shadow-lg m-5">
                <img class="h-64 w-full opacity-80 object-cover absolute top-0" style="z-index:-1"
                     src="{{ asset('img/background.jpg') }}" alt=""/>
                {{--<a href="#" class="block absolute top-4 right-3 w-5 mr-2 text-themeColor transform hover:scale-110">--}}
                {{--    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
                {{--         stroke="currentColor">--}}
                {{--        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
                {{--              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>--}}
                {{--    </svg>--}}
                {{--</a>--}}
                <div class="w-full flex mt-32 ml-12 text-white">
                    <img class="w-28 h-28 p-1 bg-white rounded-full"
                         src="{{ $student->profile_photo_url }}"
                         alt="{{ $student->name }}"/>
                    <div class="mt-7 ml-5 font-bold flex flex-col">
                        <div class="break-words">
                            <span class="text-2xl text-shadow-xl">{{ $student->name }}</span>
                        </div>
                        <div class="break-words">
                            <span class="text-lg text-shadow-xl">{{ $student->email }}</span>
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
                <form action="{{ route('admin.student.update', ['student' => $student->id]) }}" method="POST">
                    <div class="grid grid-cols-3 gap-4 mb-4 mt-12 px-12">
                        @csrf
                        @method('PUT')
                        @foreach(config('const.CLASS') as $class_key => $class)
                            <div class="flex justify-end items-center mx-auto w-40"
                                 x-data="{toggle: '{{ $student->attendances()->first()->$class_key }}'}">
                                <p class="mr-4">{{ $class }}</p>
                                <div class="relative rounded-full w-12 h-6 transition duration-200 ease-linear"
                                     :class="[toggle === '1' ? 'bg-themeColor' : 'bg-gray-300']">
                                    <label for="{{ $class_key }}"
                                           class="absolute left-0 bg-white border-2 mb-2 w-6 h-6 rounded-full transition transform duration-100 ease-linear cursor-pointer"
                                           :class="[toggle === '1' ? 'translate-x-full border-themeColor' : 'translate-x-0 border-gray-300']"></label>
                                    <input type="checkbox" id="{{ $class_key }}" name="{{ $class_key }}"
                                           :checked="toggle === '1'"
                                           class="appearance-none cursor-pointer w-full h-full active:outline-none focus:outline-none"
                                           @click="toggle === '0' ? toggle = '1' : toggle = '0'"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit"
                            class="float-right bg-themeColor font-semibold text-white mb-3 mr-5 px-5 py-2 rounded-xl text-sm focus:outline-none">
                        保存
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
