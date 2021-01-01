@if(request()->is('admin*'))

    <!-- コンソール画面 -->
    <x-jet-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
        {{ __('コンソール画面') }}
    </x-jet-nav-link>

    <!-- 生徒一覧 -->
    <x-jet-nav-link href="{{ route('admin.student') }}" :active="request()->routeIs('admin.student')">
        {{ __('生徒一覧') }}
    </x-jet-nav-link>

    <!-- 映像一覧 -->
    <x-jet-nav-link href="{{ route('admin.video') }}" :active="request()->routeIs('admin.video')">
        {{ __('映像一覧') }}
    </x-jet-nav-link>

@else

    <!-- ホーム -->
    <x-jet-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
        {{ __('ホーム') }}
    </x-jet-nav-link>

    <!-- 数学I -->
    @if(Auth::user()->attendances()->first()->math1)
        <x-jet-nav-link href="{{ route('math1') }}" :active="request()->is('math1*')">
            {{ config('const.CLASS')['math1'] }}
        </x-jet-nav-link>
    @endif

    <!-- 数学Ⅱ -->
    @if(Auth::user()->attendances()->first()->math2)
        <x-jet-nav-link href="{{ route('math2') }}" :active="request()->is('math2*')">
            {{ config('const.CLASS')['math2'] }}
        </x-jet-nav-link>
    @endif

    <!-- 数学Ⅲ -->
    @if(Auth::user()->attendances()->first()->math3)
        <x-jet-nav-link href="{{ route('math3') }}" :active="request()->is('math3*')">
            {{ config('const.CLASS')['math3'] }}
        </x-jet-nav-link>
    @endif

    <!-- 数学A -->
    @if(Auth::user()->attendances()->first()->mathA)
        <x-jet-nav-link href="{{ route('mathA') }}" :active="request()->is('mathA*')">
            {{ config('const.CLASS')['mathA'] }}
        </x-jet-nav-link>
    @endif

    <!-- 数学B -->
    @if(Auth::user()->attendances()->first()->mathB)
        <x-jet-nav-link href="{{ route('mathB') }}" :active="request()->is('mathB*')">
            {{ config('const.CLASS')['mathB'] }}
        </x-jet-nav-link>
    @endif

    <!-- ウォッチリスト -->
    <x-jet-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
        {{ __('ウォッチリスト') }}
    </x-jet-nav-link>

    <!-- 管理者ページへ -->
    @if(Auth::user()->grade == 0)
        <x-jet-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
            {{ __('管理者ページへ') }}
        </x-jet-nav-link>
    @endif

@endif
