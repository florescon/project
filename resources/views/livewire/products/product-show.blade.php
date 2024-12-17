<article class="w-full col-span-4 py-5 mx-auto mt-10 md:col-span-3" style="max-width:700px">
    {{-- <img class="w-full my-2 rounded-lg" src="{{ $product->getThumbnailUrl() }}" alt="thumbnail"> --}}
    {{ $product->getMedia('product-images')->first() }}
    <h1 class="text-4xl font-bold text-left text-gray-800">
        {{ $product->name }}
    </h1>
    <div class="flex items-center justify-between mt-2">
        <div class="flex items-center py-5">
            {{-- <span class="text-sm text-gray-500">| {{ $product->getReadingTime() }} min read</span> --}}
        </div>
        <div class="flex items-center">
            <span class="mr-2 text-gray-500">{{ $product->created_at->diffForHumans() }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3"
                stroke="currentColor" class="w-5 h-5 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <div
        class="flex items-center justify-between px-2 py-4 my-6 text-sm border-t border-b border-gray-100 article-actions-bar">
        <div class="flex items-center">
            <livewire:like-button-product :key="'like-' . $product->id" :$product />
        </div>
        <div>
            <div class="flex items-center">

                <div
                    class="flex justify-center p-4 border-gray-300 dark:border-gray-700">

                    <a wire:click.prevent="addToCart({{ $product->id }})" href="#"
                        class="text-white inline flex bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="w-4 h-4 bi bi-cart3 mr-2"
                            viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                        <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Agregar</span>
                        <span wire:loading wire:target="addToCart({{ $product->id }})">Cargando...</span>
                    </a>

                </div>

                <x-products.qr-item :product="$product" />
            </div>
        </div>
    </div>

    <div class="py-3 text-lg prose text-justify text-gray-800 article-content">
        {!! $product->description !!}
    </div>

    <div class="flex items-center mt-10 space-x-4">
        @foreach ($product->categories as $category)
            <x-products.category-badge :category="$category" />
        @endforeach
    </div>

    {{-- <livewire:post-comments :key="'comments' . $product->id" :$product /> --}}
</article>