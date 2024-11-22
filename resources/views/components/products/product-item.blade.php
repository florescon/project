@props(['product'])
<article {{ $attributes->merge(['class' => '[&:not(:last-child)]:border-b border-gray-100 pb-10']) }}>
    <div class="grid items-start grid-cols-12 gap-3 mt-5 article-body">
        <div class="flex items-center col-span-4 article-thumbnail">
            <a wire:navigate href="{{ route('products.show', $product->slug) }}">
                {{-- <img class="mx-auto mw-100 rounded-xl" src="{{ $product->getThumbnailUrl() }}" alt="thumbnail"> --}}

                {{ $product->getMedia('product-images')->first() }}
            </a>
        </div>
        <div class="col-span-8">
            <div class="flex items-center py-1 text-sm article-meta">
                {{-- <x-products.author :author="$product->author" size="xs" /> --}}
                <span class="text-xs text-gray-500">. {{ $product->published_at->diffForHumans() }}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                <a wire:navigate href="{{ route('products.show', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h2>

            <p class="mt-2 text-base font-light text-gray-700">
                {{-- {{ $product->getExcerpt() }} --}}
            </p>
            <div class="flex items-center justify-between mt-6 article-actions-bar">
                <div class="flex gap-x-2">
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
