<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @include('components.breadcrumbs', [
                'first_link' => route('admin.index'),
                'first_label' => '管理者ページ',
                'second_link' => route('admin.student.index'),
                'second_label' => '受講生一覧',
                'last_link' => route('admin.student.create'),
                'last_label' => '受講生を追加'
            ])

            <div class="border w-full relative flex flex-col mx-auto shadow-lg m-5">
                <form action="{{ route('admin.student.store') }}" method="POST">
                    <img class="h-64 w-full opacity-80 object-cover absolute top-0" style="z-index:-1"
                         src="{{ asset('img/background.jpg') }}" alt=""/>
                    <div class="w-full flex justify-between mt-40 sm:mt-32 px-4 sm:px-12 text-white">
                        <div class="md:flex">
                            <div class="mt-2 sm:mt-7 ml-3 sm:ml-5 font-bold flex flex-col">
                                <div class="break-words">
                                    <input type="text" name="name" autocomplete="name" placeholder="氏名" required
                                           class="border-none font-semibold h-8 sm:h-10 -mt-1 px-4 rounded-lg sm:rounded-xl text-sm sm:text-base w-28 sm:w-auto text-gray-600 tracking-widest focus:outline-none">
                                </div>
                                <div class="break-words">
                                    <input type="email" name="email" autocomplete="email" placeholder="メールアドレス" required
                                           class="border-none font-semibold h-6 sm:h-8 mt-1 px-4 rounded-lg sm:rounded-xl text-sm sm:text-base w-28 sm:w-auto text-gray-600 tracking-widest focus:outline-none">
                                </div>
                            </div>
                            <div>
                                <p class="ml-3 mt-1 md:mt-7">仮パスワード</p>
                                <input type="text" name="password" readonly
                                       value="{{ substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 12) }}"
                                       class="border-none font-semibold h-6 sm:h-8 ml-3 mt-1 px-4 rounded-lg sm:rounded-xl text-sm sm:text-base w-40 text-gray-600 tracking-widest focus:outline-none">
                            </div>
                        </div>
                        <div>
                            <select name="grade"
                                    class="form-select border-none text-gray-600 h-14 sm:h-auto rounded-lg shadow-md mt-2 sm:mt-10">
                                <option value="1" selected>1回生</option>
                                <option value="2">2回生</option>
                                <option value="3">3回生</option>
                                <option value="0">管理者</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-4 mt-16 sm:mt-12 sm:px-12">
                        @csrf
                        @method('POST')
                        @foreach(config('const.CLASS') as $class_key => $class)
                            <div
                                class="flex justify-end items-center mx-auto w-28 sm:w-40"
                                x-data="{toggle: '0'}">
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
