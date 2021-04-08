<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.student.index') }}" class="block mb-2">生徒一覧</a>
            <a href="{{ route('admin.video') }}" class="block mb-2">映像一覧</a>
            <a href="{{ route('admin.share.index') }}" class="block mb-2">共有一覧</a>
            <form action="{{ route('admin.createVideoThumbnail') }}" class="mb-2" method="POST">
                @csrf
                <button type="submit">サムネ生成</button>
            </form>
        </div>
    </div>
</x-app-layout>
