<div class="px-3 py-6 lg:px-7">
    <div class="flex items-center justify-between border-b border-gray-100">
        <div class="text-gray-600">
            @if ($search)
                <button class="mr-3 text-xs gray-500" wire:click="clearFilters()">X</button>
            @endif
            @if ($search)
                <span class="ml-2">
                    {{ __('blog.containing') }} : <strong>{{ $search }}</strong>
                </span>
            @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">

            {{-- <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4"
                wire:click="setSort('desc')"> {{ __('blog.latest') }}</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4 "
                wire:click="setSort('asc')"> {{ __('blog.oldest') }}</button> --}}
        </div>
    </div>
    <div class="py-4">


        @forelse ($this->pizzas as $pizza)
            <article >
                <div class="grid items-start grid-cols-12 gap-3 mt-5 article-body">
                    <div class="flex items-center col-span-4 article-thumbnail">
                        {{-- <a wire:navigate href="{{ route('products.show', $pizza->slug) }}"> --}}
                            {{-- <img class="mx-auto mw-100 rounded-xl" src="{{ $pizza->getThumbnailUrl() }}" alt="thumbnail"> --}}

                            {{-- {{ $pizza->getMedia('product-images')->first() }} --}}
                        {{-- </a> --}}
                    </div>
                    <div class="col-span-8">
                        <div class="flex items-center py-1 text-sm article-meta">
                            {{-- <x-products.author :author="$pizza->author" size="xs" /> --}}
                            <span class="text-xs text-gray-500">. {{ $pizza->if }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">
                            {{-- <a wire:navigate href="{{ route('products.show', $pizza->slug) }}"> --}}
                                {{ $pizza->name }}
                            {{-- </a> --}}
                        </h2>

                        <p class="mt-2 text-base font-light text-gray-700">
                            {{-- {{ $pizza->getExcerpt() }} --}}
                        </p>
                        <div class="flex items-center justify-between mt-6 article-actions-bar">
                            <div class="flex gap-x-2">
                                
                                <x-secondary-button wire:click="$dispatch('openModal', { component: 'pizza-modal', arguments: { pizza: {{ $pizza }} }})">
                                    Agregar
                                </x-secondary-button>

                                <div class="flex items-center space-x-4">
                                    {{-- <span class="text-sm text-gray-500">{{ $pizza->getReadingTime() }} --}}
                                        {{-- {{ __('blog.min_read') }}</span> --}}
                                </div>
                            </div>
                            <div>
                                {{-- <livewire:like-button-product :key="'like-' . $pizza->id" :$pizza /> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <p>
                No se encontraron pizzas.
            </p>
        @endforelse
    </div>

    <div class="my-3">
        {{ $this->pizzas->onEachSide(1)->links() }}
    </div>

</div>
