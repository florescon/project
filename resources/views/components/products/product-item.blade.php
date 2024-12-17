@props(['product'])
<article {{ $attributes->merge(['class' => '[&:not(:last-child)]:border-b border-gray-100 pb-10']) }}>
    <div class="grid items-start grid-cols-12 gap-3 mt-5 article-body">
        <div class="flex items-center col-span-4 article-thumbnail">
            @if($product->slug)
                <a wire:navigate href="{{ route('products.show', $product->slug) }}">
                    {{-- <img class="mx-auto mw-100 rounded-xl" src="{{ $product->getThumbnailUrl() }}" alt="thumbnail"> --}}

                    {{ $product->getMedia('product-images')->first() }}
                </a>
            @endif
        </div>
        <div class="col-span-8">
            <div class="flex items-center py-1 text-sm article-meta">
                {{-- <x-products.author :author="$product->author" size="xs" /> --}}
                <span class="text-xs text-gray-500">. {{ $product->published_at ? $product->published_at->diffForHumans() : ''  }}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                @if($product->slug)
                    <a wire:navigate href="{{ route('products.show', $product->slug) }}">
                        {{ $product->name }}
                    </a>
                @endif
            </h2>

            <p class="mt-2 text-base font-light text-gray-700">
                {{-- {{ $product->getExcerpt() }} --}}
            </p>
            <div class="flex items-center justify-between mt-6 article-actions-bar">
                <div class="flex gap-x-2">

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

                    @foreach ($product->categories as $category)
                        <x-products.category-badge :category="$category" />
                    @endforeach

                    <div class="flex items-center space-x-4">
                        {{-- <span class="text-sm text-gray-500">{{ $product->getReadingTime() }} --}}
                            {{-- {{ __('blog.min_read') }}</span> --}}
                    </div>
                </div>
                <div>
                    <livewire:like-button-product :key="'like-' . $product->id" :$product />
                </div>
            </div>
        </div>
    </div>
</article>
