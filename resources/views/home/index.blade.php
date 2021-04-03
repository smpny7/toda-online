<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <h1 class="font-bold text-3xl text-gray-700 tracking-widest my-12">受講中の講座</h1>
            <div class="grid grid-cols-3 gap-8">
                @foreach(config('const.CLASS') as $class_key => $class)
                    <div class="flex items-center flex-wrap max-w-md mb-6 px-10 bg-white shadow-xl rounded-2xl h-20">
                        <div class="flex items-center justify-center -m-6 overflow-hidden bg-white rounded-full">
                            <svg class="w-32 h-32 transform translate-x-1 translate-y-1" aria-hidden="true">
                                <circle
                                    class="text-gray-300"
                                    stroke-width="10"
                                    stroke="currentColor"
                                    fill="transparent"
                                    r="50"
                                    cx="60"
                                    cy="60"
                                />
                                <circle
                                    class="text-themeColor"
                                    stroke-width="10"
                                    stroke-dasharray="314.159"
                                    stroke-dashoffset="251.3272"
                                    stroke-linecap="round"
                                    stroke="currentColor"
                                    transform="rotate(-90) translate(-120 0)"
                                    fill="transparent"
                                    r="50"
                                    cx="60"
                                    cy="60"
                                />
                            </svg>
                            <span class="absolute text-2xl text-themeColor">80%</span>
                        </div>
                        <p class="ml-10 font-medium text-gray-600 sm:text-xl">{{ $class }}</p>
                        <span class="ml-auto text-md font-medium {{ $attendance->$class_key ? 'text-themeColor' : 'text-gray-300' }} hidden sm:block">{{ $attendance->$class_key ? '受講中' : '未受講' }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
