<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('生徒一覧') }}
        </h2>
    </x-slot>

    <div class="bg-repeat py-12" style="background-image: url({{ asset('img/home-background.png') }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($students as $student)
                <form action="{{ route('admin.updateStudent', ['id' => $student->id]) }}" method="POST">
                    <li>
                        @csrf
                        <span>{{ $student->name }}</span>
                        <label class="ml-7" for="grade">学年</label>
                        <select name="grade" id="grade" onchange="submit(this.form)" @if(Auth::user()->id == $student->id) disabled @endif>
                            @for($i=1; $i<=3; $i++)
                                <option value="{{ $i }}" @if($student->grade == $i) selected @endif>
                                    {{ $i }}年生
                                </option>
                            @endfor
                            <option value="0" @if($student->grade == 0) selected @endif>管理者</option>
                        </select>
                        <a href="{{ route('admin.studentDetail', ['id' => $student->id]) }}" class="ml-5">詳細</a>
                    </li>
                </form>
            @endforeach
        </div>
    </div>
</x-app-layout>
