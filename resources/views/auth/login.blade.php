<x-guest-layout>
    <x-jet-authentication-card>
        <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">戸田塾オンライン</h1>
        <form class="mt-10" action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-gray-700">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       placeholder="メールアドレスを入力" autofocus autocomplete required
                       class="w-full px-4 py-3 rounded-lg bg-white mt-2 border focus:border-themeColor focus:outline-none">
            </div>

            <div class="mt-4">
                <label for="password" class="block text-gray-700">{{ __('Password') }}</label>
                <input type="password" name="password" id="password" placeholder="パスワードを入力"
                       minlength="6" required autocomplete="current-password"
                       class="w-full px-4 py-3 rounded-lg bg-white mt-2 border focus:border-themeColor focus:outline-none">
            </div>

            @if (Route::has('password.request'))
                <div class="text-right mt-2">
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-themeColor">
                        パスワードを忘れた方はこちら</a>
                </div>
            @endif

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-4"/>

            <hr class="my-6 border-gray-300 w-full">

            <div class="block mt-4">
                <div class="flex justify-start items-start">
                    <span
                        class="bg-white border rounded w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2">
                        <input id="remember_me" name="remember" type="checkbox" class="opacity-0 absolute">
                        <svg class="fill-current hidden w-4 h-4 text-themeColor pointer-events-none"
                             viewBox="0 0 20 20">
                            <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
                        </svg>
                    </span>
                    <label for="remember_me" class="select-none text-gray-700">{{ __('Remember me') }}</label>
                </div>
                <style>
                    input:checked + svg {
                        display: block;
                    }
                </style>
            </div>

            <button type="submit"
                    class="w-full block bg-themeColor text-white font-semibold rounded-lg px-4 py-3 mt-8">
                {{ __('Login') }}
            </button>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
