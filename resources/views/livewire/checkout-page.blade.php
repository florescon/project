<article class="w-full col-span-4 py-5 mx-auto mt-10 md:col-span-3">
    <div class="w-full max-w-[85rem] pb-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
            @lang('Checkout')
        </h1>
        <form action="" wire:submit.prevent="checkout">
            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-12 lg:col-span-8 col-span-12">
                    <!-- Card -->
                    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                        <!-- Shipping Address -->
                        <div class="mb-6">
                            <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                                @lang('Shipping Address')
                            </h2>
<div x-data="{ open: false }" class="relative">
    <!-- Input de búsqueda/visualización -->
    <input 
        x-on:click="open = true"
        placeholder="@lang('Seleccionar')"
        class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none cursor-pointer"
        readonly
        value="{{ $selectedAddressId ? $addresses->firstWhere('id', $selectedAddressId)?->full_address : '' }}"
        @click.outside="open = false"
    >                
                <!-- Dropdown de opciones -->
                <div 
                    x-show="open"
                    x-transition
                    class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg max-h-60 overflow-auto border dark:border-gray-700"
                >
                    <!-- Barra de búsqueda -->
        {{-- <div class="p-2 border-b dark:border-gray-700" @click.stop>
            <input 
                wire:model.debounce.300ms="addressSearch"
                placeholder="@lang('Search addresses...')"
                class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600"
                @click.stop
                @focus="open = true"
            >
        </div> --}}
                    
                    <!-- Lista de direcciones -->
                    @forelse($addresses as $address)
                        <div 
                            wire:click="selectAddress({{ $address->id }})"
                            @click="open = false"
                            class="p-3 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer border-b dark:border-gray-700
                                   {{ $selectedAddressId == $address->id ? 'bg-gray-100 dark:bg-gray-700' : '' }}"
                        >
                            <p class="font-medium">{{ $address->full_address }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $address->city }}, {{ $address->state }}</p>
                        </div>
                    @empty
                        <div class="p-3 text-gray-500 dark:text-gray-400">
                            @lang('No addresses found')
                        </div>
                    @endforelse
                    
                    <!-- Opción para agregar nueva dirección -->
                    {{-- <div 
                        wire:click="showNewAddressForm"
                        @click="open = false"
                        class="p-3 bg-blue-50 dark:bg-blue-900 hover:bg-blue-100 dark:hover:bg-blue-800 cursor-pointer text-blue-600 dark:text-blue-300 font-medium flex items-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        @lang('Add new address')
                    </div> --}}
                </div>
            </div>


                        </div>

            <div class="mt-6 p-4 border rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                <h3 class="text-lg font-medium mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    @lang('New Address Information')
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 dark:text-white mb-1" for="street">
                            @lang('Street')
                        </label>
                        <input wire:model="street"
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                            @error('street') border-red-500 @enderror"
                            id="street" type="text">
                        @error('street')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 dark:text-white mb-1" for="num">
                            @lang('Number')
                        </label>
                        <input wire:model="num"
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                            @error('num') border-red-500 @enderror"
                            id="num" type="number">
                        @error('num')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 dark:text-white mb-1" for="departament">
                            @lang('Departament')
                        </label>
                        <input wire:model="departament"
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                            @error('departament') border-red-500 @enderror"
                            id="departament" type="text">
                        @error('departament')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 dark:text-white mb-1" for="zip">
                            @lang('ZIP Code')
                        </label>
                        <input wire:model="zip"
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                            @error('zip') border-red-500 @enderror"
                            id="zip" type="text" maxlength="5">
                        @error('zip')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 dark:text-white mb-1" for="city">
                            @lang('City')
                        </label>
                        <input wire:model="city" readonly
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none bg-gray-100 dark:bg-gray-600"
                            id="city" type="text">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 dark:text-white mb-1" for="state">
                            @lang('State')
                        </label>
                        <input wire:model="state" readonly
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none bg-gray-100 dark:bg-gray-600"
                            id="state" type="text">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 dark:text-white mb-1" for="country">
                            @lang('Country')
                        </label>
                        <select wire:model="country"
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                            id="country">
                            <option value="mx">México</option>
                            <!-- Agrega más países si es necesario -->
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 dark:text-white mb-1" for="note">
                            @lang('Note')
                        </label>
                        <input wire:model="note"
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                            @error('note') border-red-500 @enderror"
                            id="note" type="tel">
                        @error('note')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex space-x-3 mt-6">
                    <button 
                        type="button"
                        wire:click="saveNewAddress"
                        wire:loading.attr="disabled"
                        class="flex-1 bg-blue-500 p-3 rounded-lg text-white hover:bg-blue-600 flex items-center justify-center"
                    >
                        <span wire:loading.remove wire:target="saveNewAddress">
                            @lang('Save Address')
                        </span>
                        <span wire:loading wire:target="saveNewAddress">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            @lang('Saving...')
                        </span>
                    </button>
                    
                    <button 
                        type="button"
                        wire:click="$set('showNewAddressForm', false)"
                        class="flex-1 p-3 rounded-lg border dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700"
                    >
                        @lang('Cancel')
                    </button>
                </div>
            </div>


<div class="text-lg font-semibold mb-4">
    @lang('Delivery Type')
</div>
<ul class="grid w-full gap-6 md:grid-cols-3">
    <li>
        <input wire:model="shipping" class="hidden peer" id="delivery-takeaway" required=""
            type="radio" value="takeaway" />
        <label
            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
            for="delivery-takeaway">
            <div class="block">
                <div class="w-full text-lg font-semibold">
                    @lang('Takeaway')
                </div>
            </div>
            <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2">
                </path>
            </svg>
        </label>
    </li>
    <li>
        <input wire:model="shipping" class="hidden peer" id="delivery-home" type="radio"
            value="delivery">
        <label
            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
            for="delivery-home">
            <div class="block">
                <div class="w-full text-lg font-semibold">
                    @lang('Home Delivery')
                </div>
            </div>
            <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2">
                </path>
            </svg>
        </label>
    </li>
    <li>
        <input wire:model="shipping" class="hidden peer" id="delivery-restaurant" type="radio"
            value="local">
        <label
            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
            for="delivery-restaurant">
            <div class="block">
                <div class="w-full text-lg font-semibold">
                    @lang('Restaurant')
                </div>
            </div>
            <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2">
                </path>
            </svg>
        </label>
    </li>
</ul>

                        @error('shipping')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror

                        <div class="text-lg font-semibold mb-4">
                            @lang('Select Payment Method')
                        </div>
                        <ul class="grid w-full gap-6 md:grid-cols-2">
                            <li>
                                <input wire:model="payment_method" class="hidden peer" id="hosting-small" required=""
                                    type="radio" value="cod" />
                                <label
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                    for="hosting-small">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">
                                            @lang('Cash on Delivery')
                                        </div>
                                    </div>
                                    <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                        viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                        </path>
                                    </svg>
                                </label>
                            </li>
                            <li>
                                <input wire:model="payment_method" class="hidden peer" id="hosting-big" type="radio"
                                    value="stripe" disabled>
                                <label
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-gray-100 border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                    for="hosting-big">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">
                                            Stripe (Disabled)
                                        </div>
                                    </div>
                                    <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                        viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                        </path>
                                    </svg>
                                </label>
                                </input>
                            </li>
                        </ul>
                        @error('payment_method')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Card -->
                </div>
                <div class="md:col-span-12 lg:col-span-4 col-span-12">
                    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                        <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            @lang('ORDER SUMMARY')
                        </div>
                        <div class="text-xl font-bold underline text-gray-700 dark:text-white my-4">
                            <input wire:model="number"
                                class="w-full rounded-lg text-center border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                id="number" type="text" disabled>
                            </input>
                        </div>
                        <div class="flex justify-between mb-2 font-bold">
                            <span>
                                @lang('Subtotal')
                            </span>
                            <span>
                                {{ Number::currency($grand_total, 'MXN') }}
                            </span>
                        </div>
                        <div class="flex justify-between mb-2 font-bold">
                            <span>
                                @lang('Taxes')
                            </span>
                            <span>
                                {{ Number::currency(0, 'MXN') }}
                            </span>
                        </div>
                        <div class="flex justify-between mb-2 font-bold">
                            <span>
                                @lang('Shipping Cost')
                            </span>
                            <span>
                                {{ Number::currency(0, 'MXN') }}
                            </span>
                        </div>
                        <hr class="bg-slate-400 my-4 h-1 rounded">
                        <div class="flex justify-between mb-2 font-bold">
                            <span>
                                @lang('Grand Total')
                            </span>
                            <span>
                                {{ Number::currency($grand_total, 'MXN') }}
                            </span>
                        </div>
                        </hr>
                    </div>
                    @if($selectedAddressId && !$showNewAddressForm)
                    <button type="submit"
                        class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                        
                        <span wire:loading.remove>@lang('Place Order')</span>
                        <span wire:loading>@lang('Processing')...</span>
                    </button>
                    @endif
                    <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                        <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            @lang('BASKET SUMMARY')
                        </div>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                            @foreach ($cart_items as $item)
                                <li class="py-3 sm:py-4" wire:key="{{ $item['shop_product_id'] }}">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            {{-- <img alt="Neil image" class="w-12 h-12 rounded-full"
                                                src="{{ url('storage', $item['image']) }}">
                                            </img> --}}
                                        </div>
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                {{ $item['name'] }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                @lang('Quantity'): 
                                                {{ $item['qty'] ?? '' }} 
                                                {{ $item['quantity'] ?? '' }}
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            {{ NUmber::currency($item['total_amount'], 'MXN') }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</article>


@push('scripts')
<script>
    // Inicializar Alpine.js para el comportamiento del dropdown
    document.addEventListener('alpine:init', () => {
        Alpine.data('addressSelect', () => ({
            open: false,
            toggle() {
                this.open = !this.open
            }
        }))
    })
</script>
@endpush