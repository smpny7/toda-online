<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.createShareLink', ['video_id' => $video->id]) }}" method="POST">
                @csrf
                <div
                    class='flex max-w-sm w-full h-full justify-center bg-white shadow-md rounded-2xl overflow-hidden mx-auto flex flex-col px-12 py-10'>
                    <h3 class="text-2xl font-bold mb-4">共有を作成</h3>

                    <div class="relative h-10 empty mt-4">
                        <input
                            id="title" type="text" name="title" required
                            class="h-full w-full border-gray-300 px-2 transition-all duration-150 rounded-xl"
                        />
                        <label for="title" class="absolute left-2 transition-all duration-150 bg-white px-1">
                            任意の共有名
                        </label>
                    </div>

                    <div class="relative h-10 mt-4">
                        <input
                            id="start" type="datetime-local" name="start" required
                            value="{{ str_replace(" ", "T", (new DateTime('now'))->format('Y-m-d H:i')) }}"
                            class="h-full w-full border-gray-300 px-2 transition-all duration-150 rounded-xl"
                        />
                        <label for="start" class="absolute left-2 transition-all duration-150 bg-white px-1">
                            開始日
                        </label>
                    </div>

                    <div class="relative h-10 mt-4">
                        <input
                            id="end" type="datetime-local" name="end" required
                            value="{{ str_replace(" ", "T", (new DateTime('now'))->modify('+1 weeks')->format('Y-m-d H:i')) }}"
                            class="h-full w-full border-gray-300 px-2 transition-all duration-150 rounded-xl"
                        />
                        <label for="end" class="absolute left-2 transition-all duration-150 bg-white px-1">
                            終了日
                        </label>
                    </div>

                    <button class="block bg-themeColor h-10 text-white rounded-xl mt-8" type="submit">作成</button>
                </div>
            </form>

            <style>
                label {
                    top: 0;
                    transform: translateY(-50%);
                    font-size: 11px;
                    color: #FF9113;
                }

                .empty input:not(:focus) + label {
                    top: 50%;
                    transform: translateY(-50%);
                    font-size: 14px;
                }

                input:not(:focus) + label {
                    color: #464646;
                }

                input {
                    border-width: 1px;
                }

                input:focus {
                    outline: none;
                    border-color: #FF9113;
                }
            </style>
            <script>
                const input = document.getElementById('title');
                input.addEventListener('input', () => {
                    if (!input.value)
                        input.parentElement.classList.add('empty')
                    else
                        input.parentElement.classList.remove('empty')
                })
            </script>
        </div>
    </div>
</x-app-layout>
