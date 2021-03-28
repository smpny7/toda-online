<!-- Page Sidebar -->
<aside class="h-screen overflow-hidden items-center justify-center fixed top-0 z-40 webkit-fill-available
    @if($position == 'left') hidden xl:flex left-0 @elseif($position == 'right') hidden xl:hidden right-0 @endif"
       style="min-height: calc(var(--vh, 1vh) * 100)"
       @if($position == 'right') id="nav-right" x-show="open" x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0" @endif xmlns:x-transition="">
    <div class="flex items-center justify-center xl:py-6 w-80">
        <div class="h-screen flex w-full max-w-xs p-4 bg-gray-800 webkit-fill-available"
             style="min-height: calc(var(--vh, 1vh) * 100)">
            <ul class="flex flex-col w-full">

                <div class="hidden xl:block border-b-2 border-gray-500 pb-3">
                    <a href="{{ route('home') }}" class="px-2">
                        <x-jet-application-mark/>
                        <h1 class="inline-block text-lg text-gray-100 tracking-wider ml-2 relative top-0.5">
                            戸田塾オンライン</h1>
                    </a>
                </div>

                <div class="mt-12 xl:mt-6 h-screen overflow-y-scroll">
                    {{-- ホーム --}}
                    @include('layouts.aside.navigation-link', [
                        'active' => request()->routeIs('home'),
                        'icon' => '<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
                        'icon_color' => 'text-gray-500',
                        'label' => 'ホーム',
                        'link' => route('home')
                    ])

                    {{-- 検索 --}}
                    @include('layouts.aside.navigation-link', [
                        'active' => request()->routeIs('search'),
                        'icon' => '<svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" viewBox="-2.5 -2.5 24 24" stroke="currentColor" preserveAspectRatio="xMinYMin" class="h-6 w-6"><path d="M8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12zm6.32-1.094l3.58 3.58a1 1 0 1 1-1.415 1.413l-3.58-3.58a8 8 0 1 1 1.414-1.414z"></path></svg>',
                        'icon_color' => 'text-gray-500',
                        'label' => '検索',
                        'link' => route('search')
                    ])


                    {{-- 【 受講講座一覧 】 --}}
                    @include('layouts.aside.navigation-title', [
                        'label' => '受講講座一覧'
                    ])

                    {{-- 講座 --}}
                    @foreach(config('const.CLASS') as $class_key => $class)
                        @if(Auth::user()->attendances()->first()-> $class_key)
                            @include('layouts.aside.navigation-link', [
                                'active' => request()->is($class_key . '*'),
                                'icon' => '<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>',
                                'icon_color' => 'text-gray-500',
                                'label' => $class,
                                'link' => route('class', ['class_key' => $class_key])
                            ])
                        @endif
                    @endforeach

                    {{-- 新規講座を追加 --}}
                    @include('layouts.aside.navigation-link', [
                        'active' => false,
                        'icon' => '<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                        'icon_color' => 'text-green-400',
                        'label' => '新規講座を追加',
                        'link' => '#'
                    ])



                    {{-- 【 アカウント 】 --}}
                    @include('layouts.aside.navigation-title', [
                        'label' => 'アカウント'
                    ])

                    {{-- プロフィール --}}
                    @include('layouts.aside.navigation-link', [
                        'active' => request()->routeIs('profile.show'),
                        'icon' => '<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>',
                        'icon_color' => 'text-gray-500',
                        'label' => 'プロフィール',
                        'link' => route('profile.show')
                    ])

                    {{-- お知らせ --}}
                    @include('layouts.aside.navigation-link', [
                        'active' => false,
                        'badge' => null,
                        'icon' => '<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>',
                        'icon_color' => 'text-gray-500',
                        'label' => 'お知らせ',
                        'link' => '#'
                    ])

                    {{-- 管理者ページ --}}
                    @if(Auth::user()->grade == 0)
                        @include('layouts.aside.navigation-link', [
                            'active' => request()->routeIs('admin.index'),
                            'icon' => '<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>',
                            'icon_color' => 'text-gray-500',
                            'label' => '管理者ページ',
                            'link' => route('admin.index')
                        ])
                    @endif

                    {{-- ログアウト --}}
                    @if(Auth::user()->grade == 0)
                        @include('layouts.aside.navigation-link', [
                            'active' => false,
                            'icon' => '<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6"><path d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>',
                            'icon_color' => 'text-red-400',
                            'label' => 'ログアウト',
                            'link' => route('logout'),
                            'logout' => true
                        ])
                    @endif

                    <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </ul>
        </div>
    </div>
</aside>
