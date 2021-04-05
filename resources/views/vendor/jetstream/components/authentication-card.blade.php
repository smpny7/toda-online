<div class="flex flex-col md:flex-row h-screen items-center">
    <div class="bg-gray-100 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
        <img src="{{ asset('img/background.jpg') }}" alt="Image" class="w-full h-full object-cover">
    </div>

    <div
        class="bg-white shadow-2xl w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center">
        <div class="w-full h-100">
            {{ $slot }}
        </div>
    </div>
</div>
