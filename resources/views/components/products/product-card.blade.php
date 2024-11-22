@props(['product'])

<div {{ $attributes }}>
    <a wire:navigate href="{{ route('products.show', $product->slug) }}">
        <div>
            {{-- <img class="w-full rounded-xl" src=""> --}}
            {{ $product->getMedia('product-images')->first() }}
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2 gap-x-2">
            @if ($category = $product->categories->first())
                <x-products.category-badge :category="$category" />
            @endif
            <p class="text-sm text-gray-500">{{ $product->created_at }} </p>
        </div>
        <a wire:navigate href="{{ route('products.show', $product->slug) }}"
            class="text-xl font-bold text-gray-900">{{ $product->name }} </a>
    </div>
</div>
