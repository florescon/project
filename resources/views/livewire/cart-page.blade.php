<article class="w-full col-span-4 py-5 mx-auto mt-10 md:col-span-3">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="container mx-auto px-4">
          <h1 class="text-2xl font-semibold mb-4">Carrito de Compras</h1>
          <br>
          @json($speciality_items)
          <br>
          <br>
          <br>
          <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
              @if(count($product_items))
              <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                <table class="w-full">
                  <thead>
                    <tr>
                      <th class="text-left font-semibold">Producto</th>
                      <th class="text-left font-semibold">Precio</th>
                      <th class="text-left font-semibold">Cantidad</th>
                      <th class="text-left font-semibold">Total</th>
                      <th class="text-left font-semibold">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($product_items as $item)
                    <tr wire:key="{{ $item['shop_product_id'] }}">
                      <td class="py-4">
                        <div class="flex items-center">
                          {{-- <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['image']) }}" alt="Product image"> --}}
                          <span class="font-semibold">{{ $item['name'] }}</span>
                        </div>
                      </td>
                      <td class="py-4">{{ Number::currency($item['unit_price'],'MXN') }}</td>
                      <td class="py-4">

                        <div class="flex items-center">
                          <button  wire:click='decreaseQty({{ $item['shop_product_id'] }})' class="border rounded-md py-2 px-4 mr-2">-</button>
                          <span class="text-center w-8">{{ $item['qty'] }}</span>
                          <button wire:click='increaseQty({{ $item['shop_product_id'] }})' class="border rounded-md py-2 px-4 ml-2">+</button>
                        </div>
                      </td>
                      <td class="py-4">{{ Number::currency($item['total_amount'],'MXN') }}</td>
                      <td><button wire:click='removeItem({{ $item['folio'] }})' class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                        <span wire:loading.remove wire:target="removeItem({{ $item['folio'] }})">Eliminar</span><span wire:loading wire:target="removeItem({{ $item['folio'] }})">Eliminar...</span>  
                      </button></td>
                    </tr>
                    @empty
                        <tr>
                          <td colspan="5" class="text-center text-gray-500 font-semibold py-4">Vacio</td>
                        </tr>
                    @endforelse
                   
                    <!-- More product rows -->
                  </tbody>
                </table>
              </div>
              @endif
              @if(count($speciality_items))
              {{-- @json($speciality_items) --}}
              <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                <table class="w-full">
                  <thead>
                    <tr>
                      <th class="text-left font-semibold">Pizza</th>
                      <th class="text-left font-semibold">Precio</th>
                      <th class="text-left font-semibold">Cantidad</th>
                      <th class="text-left font-semibold">Total</th>
                      <th class="text-left font-semibold">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($speciality_items as $item)
                    <tr wire:key="{{ $item['shop_product_id'] }}">
                      <td class="py-4">
                        <div class="flex items-center">
                          {{-- <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['image']) }}" alt="Product image"> --}}
                          <span class="font-semibold">{{ $item['choose'] == 'half' ? '[Mitad y Mitad]' : '' }} {{ $item['name'] }}</span>
                          <span class="font-extralight">&nbsp; <em>{{ implode(', ', $item['nameIngredients']) }}</em></span>
                          @if($item['choose'] == 'half')
                            <span class="font-extralight">[Segunda Mitad] {{ implode(', ', $item['nameIngredientsSecond']) }}</span>
                          @endif
                        </div>
                      </td>
                      <td class="py-4">{{ Number::currency($item['unit_price'],'MXN') }}</td>
                      <td class="py-4">

                        <div class="flex items-center">
                          <button  wire:click='decreaseQty({{ $item['shop_product_id'] }})' class="border rounded-md py-2 px-4 mr-2">-</button>
                          <span class="text-center w-8">{{ $item['quantity'] }}</span>
                          <button wire:click='increaseQty({{ $item['shop_product_id'] }})' class="border rounded-md py-2 px-4 ml-2">+</button>
                        </div>
                      </td>
                      <td class="py-4">{{ Number::currency($item['total_amount'],'MXN') }}</td>
                      <td><button wire:click='removeItem({{ $item['folio'] }})' class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                        <span wire:loading.remove wire:target="removeItem({{ $item['folio'] }})">Eliminar</span><span wire:loading wire:target="removeItem({{ $item['folio'] }})">Eliminar...</span>  
                      </button></td>
                    </tr>
                    @empty
                        <tr>
                          <td colspan="5" class="text-center text-gray-500 font-semibold py-4">Vacio</td>
                        </tr>
                    @endforelse
                   
                    <!-- More product rows -->
                  </tbody>
                </table>
              </div>
              @endif
              
              @if(!count($speciality_items) && !count($product_items))
              <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                <p>Nada por mostrar :)</p>
              </div>
              @endif

            </div>
            <div class="md:w-1/4">
              <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Resumen</h2>
                <div class="flex justify-between mb-2">
                  <span>Subtotal</span>
                  <span>{{ Number::currency($grand_total, 'MXN') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                  <span>Impuestos</span>
                  <span>{{ Number::currency(0, 'MXN') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                  <span>Envio</span>
                  <span>{{ Number::currency(0, 'MXN') }}</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                  <span class="font-semibold">Total</span>
                  <span class="font-semibold">{{ Number::currency($grand_total, 'MXN') }}</span>
                </div>
                @if (count($speciality_items) || count($product_items))
                  <a href="/checkout" class="block text-center bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Procesar</a href="/checkout">
                @endif 
              </div>
            </div>
          </div>
        </div>
    </div>
</article>