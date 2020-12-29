<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('詳細情報') }}
        </h2>
    </x-slot>

    <div class="bg-repeat py-12" style="background-image: url({{ asset('img/home-background.png') }})">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p>{{ $student->name }}</p>
            <p>{{ $student->email }}</p>
            <p>{{ isset($student->two_factor_secret) }}</p>
            <p>登録日: {{ $student->created_at }}</p>
            <p>更新日: {{ $student->updated_at }}</p>
            <form action="{{ route('admin.updateStudent', ['id' => $student->id]) }}" method="POST">
                @csrf
                <label class="ml-7" for="grade">学年</label>
                <select name="grade" id="grade" onchange="submit(this.form)"
                        @if(Auth::user()->id == $student->id) disabled @endif>
                    @for($i=1; $i<=3; $i++)
                        <option value="{{ $i }}" @if($student->grade == $i) selected @endif>
                            {{ $i }}年生
                        </option>
                    @endfor
                    <option value="0" @if($student->grade == 0) selected @endif>管理者</option>
                </select>
                @foreach(config('const.CLASS') as $class_key => $class)
                    <label for="{{ $class_key }}" class="ml-3">{{ $class }}</label>
                    <select name="{{ $class_key }}" id="{{ $class_key }}" onchange="submit(this.form)">
                        @for($i=0; $i<=1; $i++)
                            <option value="{{ $i }}" @if($student->$class_key == $i) selected @endif>
                                @if($i == 1) 受講中 @else 未受講 @endif
                            </option>
                        @endfor
                    </select>
                @endforeach
            </form>
        </div>
    </div>
</x-app-layout>
