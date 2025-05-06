<x-app-layout title="Home Page">
    @section('hero')
<section class="overflow-hidden bg-gray-50 sm:grid sm:grid-cols-2">
  <div class="p-8 md:p-12 lg:px-16 lg:py-24">
    <div class="mx-auto max-w-xl text-center ltr:sm:text-left rtl:sm:text-right">
      <h2 class="text-2xl font-bold text-gray-900 md:text-3xl p-6">
        De la huerta al horno, directo a tu mesa
      </h2>

      <p class="hidden text-gray-500 md:mt-4 md:block">
        Somos una empresa comprometida en ofrecer productos con ingredientes frescos a nuestros clientes para satisfacer sus necesidades y pasen agradable momentos
      </p>

      <div class="mt-4 md:mt-8">
        <a
          href="#"
          class="inline-block rounded-sm bg-emerald-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-emerald-700 focus:ring-3 focus:ring-yellow-400 focus:outline-hidden"
        >
          Get Started Today
        </a>
      </div>
    </div>
  </div>

  <img
    alt=""
    style="height: 600px;"
    src="{{ asset('/images/NL-161.jpg') }}"
    class="h-56 w-full object-cover sm:h-full"
  />
</section>

        {{-- <div class="w-full py-32 text-center">
            <h1 class="text-2xl font-bold text-gray-700 md:text-3xl lg:text-5xl">
                <br>
                <span class="inline-flex justify-center items-center mx-auto">
                    <img src="{{ asset('/images/francos.png') }}" class="max-w-full h-auto">
                </span>
            </h1>
            <p class="mt-1 text-lg text-gray-500">{{ __('home.hero.desc') }}</p>
            <a class="inline-block px-3 py-2 mt-5 text-lg text-white bg-gray-800 rounded" href="{{ route('products.index') }}">
                {{ __('home.hero.cta') }}</a>
        </div> --}}
    @endsection

    <div class="w-full mb-10">
        <div class="mb-16">
            <h2 class="mt-16 mb-5 text-3xl font-bold text-yellow-500"> {{ __('Featured Products') }} </h2>
            <div class="w-full">
                <div class="grid w-full grid-cols-3 gap-10">
                    @foreach ($featuredProducts as $product)
                        <x-products.product-card :product="$product" class="col-span-3 md:col-span-1" />
                    @endforeach
                </div>
            </div>
            <a class="block mt-10 text-lg font-semibold text-center text-yellow-500" href="{{ route('products.index') }}">
                {{ __('More Products') }}</a>
        </div>
        <hr>

        <h2 class="mt-16 mb-5 text-3xl font-bold text-yellow-500">{{ __('Latest Products') }}</h2>
        <div class="w-full mb-5">
            <div class="grid w-full grid-cols-3 gap-10">
                @foreach ($latestProducts as $product)
                    <x-products.product-card :product="$product" class="col-span-3 md:col-span-1" />
                @endforeach
            </div>
        </div>
        <a class="block mt-10 text-lg font-semibold text-center text-yellow-500" href="{{ route('products.index') }}">
            {{ __('More Products') }}</a>
    </div>
</x-app-layout>
