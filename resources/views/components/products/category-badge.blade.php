@props(['category'])
<x-badge wire:navigate href="{{ route('products.index', ['category' => $category->slug]) }}" :textColor="$category->text_color"
    :bgColor="$category->bg_color">
    {{ $category->name }}
</x-badge>
