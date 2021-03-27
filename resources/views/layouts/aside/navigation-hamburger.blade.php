<div class="fixed right-3 top-2 xl:hidden sm:max-w-xl mx-auto py-3 z-50">
    <nav>
        <button class="h-10 w-10 relative focus:outline-none" @click="open = !open">
            <span class="sr-only">Open main menu</span>
            <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <span aria-hidden="true"
                          class="block absolute h-0.5 w-5 transform transition duration-500 ease-in-out"
                          :class="{ 'rotate-45 bg-white': open, '-translate-y-1.5 bg-gray-500': !open }"></span>
                <span aria-hidden="true"
                      class="block absolute h-0.5 w-5 transform transition duration-500 ease-in-out"
                      :class="{ 'opacity-0 bg-white': open, 'bg-gray-500': !open } "></span>
                <span aria-hidden="true"
                      class="block absolute h-0.5 w-5 transform transition duration-500 ease-in-out"
                      :class="{ '-rotate-45 bg-white': open, 'translate-y-1.5 bg-gray-500': !open }"></span>
            </div>
        </button>
    </nav>
</div>
