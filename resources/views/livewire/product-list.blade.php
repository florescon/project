<div class="px-3 py-6 lg:px-7">
    <div class="flex items-center justify-between border-b border-gray-100">
        <div class="text-gray-600">
            @if ($this->activeCategory || $search)
                <button class="mr-3 text-xs gray-500" wire:click="clearFilters()">X</button>
            @endif
            @if ($this->activeCategory)
                <x-badge wire:navigate href="{{ route('products.index', ['category' => $this->activeCategory->slug]) }}"
                    :textColor="$this->activeCategory->text_color" :bgColor="$this->activeCategory->bg_color">
                    {{ $this->activeCategory->name }}
                </x-badge>
            @endif
            @if ($search)
                <span class="ml-2">
                    {{ __('blog.containing') }} : <strong>{{ $search }}</strong>
                </span>
            @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <x-checkbox wire:model.live="popular" />
            <x-label> {{ __('blog.popular') }} </x-label>

            @foreach($categories as $cat)
                <a class="{{ $category === $cat->slug ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4"
                href="{{ route('products.index', ['category' => $cat->slug]) }}"> {{ $cat->name }}</a>
            @endforeach

            {{-- <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4"
                wire:click="setSort('desc')"> {{ __('blog.latest') }}</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4 "
                wire:click="setSort('asc')"> {{ __('blog.oldest') }}</button> --}}
        </div>
    </div>
<div class="py-4">
    @foreach ($this->allProducts as $product)
        <x-products.product-item wire:key="product-{{ $product->id }}-{{ $loop->index }}" :product="$product" />
    @endforeach
</div>

@if ($this->hasMorePages)
    <div x-data="{
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        @this.dispatch('load-more');
                    }
                });
            }, {
                root: null,
                rootMargin: '0px',
                threshold: 0.5
            });
            
            observer.observe(this.$el);
        }
    }" class="p-4 text-center">
        <div wire:loading class="text-gray-500">
            Cargando más productos...
        </div>
    </div>
@endif
</div>
