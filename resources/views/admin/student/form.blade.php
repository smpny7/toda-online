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
                <form action="{{ route('admin.student.update', ['student' => $student->id]) }}" method="POST">
                    <img class="h-64 w-full opacity-80 object-cover absolute top-0" style="z-index:-1"
                         src="{{ asset('img/background.jpg') }}" alt=""/>
                    @if($mode != 'edit')
                        <a href="{{ route('admin.student.edit', ['student' => $student->id]) }}"
                           class="block absolute top-4 right-3 w-5 mr-2 text-themeColor transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </a>
                    @endif
                    <div class="w-full flex justify-between mt-40 sm:mt-32 px-4 sm:px-12 text-white">
                        <div class="flex">
                            <img class="w-16 h-16 sm:w-28 sm:h-28 p-1 bg-white rounded-full"
                                 src="{{ $student->profile_photo_url }}"
                                 alt="{{ $student->name }}"/>
                            <div class="mt-2 sm:mt-7 ml-3 sm:ml-5 font-bold flex flex-col">
                                <div class="break-words">
                                    @if($mode == 'edit')
                                        <input type="text" name="name" autocomplete="name" value="{{ $student->name }}"
                                               class="border-none font-semibold h-8 sm:h-10 -mt-1 px-4 rounded-lg sm:rounded-xl text-sm sm:text-base w-28 sm:w-auto text-gray-600 tracking-widest focus:outline-none">
                                    @else
                                        <span class="text-lg sm:text-2xl text-shadow-xl w-36 sm:w-auto overflow-hidden whitespace-no-wrap" style="text-overflow: ellipsis">{{ $student->name }}</span>
                                    @endif
                                </div>
                                <div class="break-words">
                                    @if($mode == 'edit')
                                        <input type="email" name="email" autocomplete="email"
                                               value="{{ $student->email }}"
                                               class="border-none font-semibold h-6 sm:h-8 mt-1 px-4 rounded-lg sm:rounded-xl text-sm sm:text-base w-28 sm:w-auto text-gray-600 tracking-widest focus:outline-none">
                                    @else
                                        <span class="inline-block text-md sm:text-lg text-shadow-xl w-36 sm:w-auto overflow-hidden whitespace-no-wrap" style="text-overflow: ellipsis">{{ $student->email }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            @if($mode == 'edit')
                                <select name="grade"
                                        class="form-select border-none text-gray-600 h-14 sm:h-auto rounded-lg shadow-md mt-2 sm:mt-10">
                                    @if($student->grade)
                                        <option value="1" @if($student->grade == 1) selected @endif>1回生</option>
                                        <option value="2" @if($student->grade == 2) selected @endif>2回生</option>
                                        <option value="3" @if($student->grade == 3) selected @endif>3回生</option>
                                    @else
                                        <option value="0" @if($student->grade == 0) selected @endif>管理者</option>
                                    @endif
                                </select>
                            @else
                                <p class="bg-themeColor font-semibold text-white rounded-md shadow-lg tracking-widest text-sm sm:text-base mt-4 sm:mt-10 px-3 py-1 sm:px-6 sm:py-2">
                                    {{ $student->grade ? $student->grade . '回生' : '管理者' }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-4 mt-16 sm:mt-12 sm:px-12">
                        @csrf
                        @method('PUT')
                        @foreach(config('const.CLASS') as $class_key => $class)
                            <div class="flex justify-end items-center mx-auto {{ $mode == 'edit' ? 'w-28' : 'w-32' }} sm:w-40"
                                 x-data="{toggle: '{{ $student->attendances()->first()->$class_key }}'}">
                                <p class="mr-4">{{ $class }}</p>
                                @if($mode == 'edit')
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
                                @else
                                    <p class="{{ $student->attendances()->first()->$class_key ? 'bg-themeColor' : 'bg-gray-300' }} font-semibold px-3 py-1 rounded-lg text-white text-xs tracking-widest">
                                        受講中</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @if($mode == 'edit')
                        <button type="submit"
                                class="float-right bg-themeColor font-semibold text-white mb-3 mr-5 px-5 py-2 rounded-xl text-sm focus:outline-none">
                            保存
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
