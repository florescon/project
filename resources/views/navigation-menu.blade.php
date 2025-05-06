<header class="bg-white">
  <div class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8">
    <a class="block text-teal-600" href="#">
        <a href="{{ route('home') }}">
            <img src="{{ asset('/images/francos.png') }}" class="h-16 mr-3" alt="Flowbite Logo" />
        </a>
    </a>

    <div class="flex flex-1 items-center justify-end md:justify-between">
      <nav aria-label="Global" 
      {{-- class="hidden md:block" --}}
      >
        <ul class="flex items-center gap-6 text-sm">
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="{{ route('products.index') }}"> {{ __('Products') }} </a>
          </li>

          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="{{ route('pizzas.index') }}"> {{ __('Pizzas') }} </a>
          </li>
        </ul>
      </nav>

      <div class="flex items-center gap-4 ml-6">
        @auth
            @include('layouts.partials.header-right-auth')
        @else
            @include('layouts.partials.header-right-guest')
        @endauth

        <button
          class="block rounded-sm bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden"
        >
          <span class="sr-only">Toggle menu</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>