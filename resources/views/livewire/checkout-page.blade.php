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
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
                                        @lang('First Name')
                                    </label>
                                    <input wire:model="first_name"
                                        class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none 
                                        @error('first_name')    
                                            border-red-500
                                        @enderror"
                                        id="first_name" type="text">
                                    </input>
                                    @error('first_name')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
                                        @lang('Last Name')
                                    </label>
                                    <input wire:model="last_name"
                                        class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                                         @error('last_name')    
                                            border-red-500
                                        @enderror"
                                        id="last_name" type="text">
                                    </input>
                                    @error('last_name')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-white mb-1" for="phone">
                                    @lang('Phone')
                                </label>
                                <input wire:model="phone"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                                    @error('phone')    
                                            border-red-500
                                        @enderror"
                                    id="phone" type="text">
                                </input>
                                @error('phone')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mt-4">
                                    <label class="block text-gray-700 dark:text-white mb-1" for="address">
                                        @lang('Street')
                                    </label>
                                    <input wire:model="street_address"
                                        class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                                        @error('street_address')    
                                                border-red-500
                                            @enderror"
                                        id="address" type="text">
                                    </input>
                                    @error('street_address')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <label class="block text-gray-700 dark:text-white mb-1" for="number_address">
                                        @lang('Number')
                                    </label>
                                    <input wire:model="number_address"
                                        class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                                        @error('number_address')    
                                                border-red-500
                                            @enderror"
                                        id="number_address" type="text">
                                    </input>
                                    @error('number_address')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-white mb-1" for="neighborhood">
                                    @lang('Neighborhood')
                                </label>
                                <input wire:model="neighborhood"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                                    @error('neighborhood')    
                                            border-red-500
                                        @enderror"
                                    id="neighborhood" type="text">
                                </input>
                                @error('neighborhood')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 dark:text-white mb-1" for="reference">
                                    @lang('Reference')
                                </label>
                                <input wire:model="reference"
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none
                                    @error('reference')    
                                            border-red-500
                                        @enderror"
                                    id="reference" type="text">
                                </input>
                                @error('reference')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
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
                    <button type="submit"
                        class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                        
                        <span wire:loading.remove>@lang('Place Order')</span>
                        <span wire:loading>@lang('Processing')...</span>
                    </button>
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