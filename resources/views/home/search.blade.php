<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('検索結果') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('search') }}" method="GET">
                <p><input type="text" name="keyword" value="{{$keyword}}"></p>
                <p><input type="submit" value="検索"></p>
            </form>

            @if($videos != null)
                <table>
                    <tr class="text-left">
                        <th>ID</th>
                        <th>CLASS</th>
                        <th>CHAPTER</th>
                        <th>SECTION</th>
                        <th>TITLE</th>
                    </tr>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ $video->id }}</td>
                            <td>{{ $video->class }}</td>
                            <td>{{ $video->chapter }}</td>
                            <td>{{ $video->section }}</td>
                            <td>{{ $video->title }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>見つかりませんでした。</p>
            @endif
        </div>
    </div>
</x-app-layout>
