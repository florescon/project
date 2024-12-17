<nav class="flex items-center justify-between px-6 py-3 border-b border-gray-100">
    <div id="nav-left" class="flex items-center">
        <a href="{{ route('home') }}">
            <x-application-mark />
        </a>
        <div class="ml-10 top-menu">
            <div class="flex space-x-4">
                <x-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')">
                    {{ __('Products') }}
                </x-nav-link>
                <x-nav-link href="{{ route('pizzas.index') }}" :active="request()->routeIs('pizzas.index')">
                    {{ __('Pizzas') }}
                </x-nav-link>
            </div>
        </div>
    </div>
    <div id="nav-right" class="flex items-center md:space-x-6">

        <x-nav-link href="{{ route('cart') }}" class="mx-3" :active="request()->routeIs('cart')">
            @livewire('partials.count-cart')
        </x-nav-link>

        @auth
            @include('layouts.partials.header-right-auth')
        @else
            @include('layouts.partials.header-right-guest')
        @endauth
    </div>
</nav>
