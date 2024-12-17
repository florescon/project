<x-app-layout :title="$product->name">
    @livewire('products.product-show', [$product->slug])
</x-app-layout>
