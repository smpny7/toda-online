<x-guest-layout>
    <x-jet-authentication-card>
        <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">パスワードリセット</h1>
        <p class="my-4 text-gray-700">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form class="mt-10" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-gray-700">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       placeholder="メールアドレスを入力" autofocus autocomplete required
                       class="w-full px-4 py-3 rounded-lg bg-white mt-2 border focus:border-themeColor focus:outline-none">
            </div>

            <button type="submit"
                    class="w-full block bg-themeColor text-white font-semibold rounded-lg px-4 py-3 mt-8">
                {{ __('Email Password Reset Link') }}
            </button>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
