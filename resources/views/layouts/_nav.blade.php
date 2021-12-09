<nav class="{{ isset($hasShadow) ? 'shadow mb-1' : '' }}">
    <div class="container mx-auto text-gray-800 lg:block lg:py-8" x-data="{ nav: false, search: false, community: false, chat: false, settings: false }" @click.outside="nav = false">
        <div class="block bg-white 2xl:-mx-10">
            <div class="lg:px-4 lg:flex">
                <div class="block lg:flex lg:items-center lg:flex-shrink-0">
                    <div class="flex justify-between items-center p-4 lg:p-0">
                        <a href="/" class="mr-4">
                            <img class="h-6 w-auto lg:h-8" src="{{ asset('img/favicon-32x32.png') }}" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
