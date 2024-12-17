<div class="p-6">
    {{-- <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"> --}}
        <form wire:submit="save">
            <div class="flex flex-col items-center pb-10">
                <h5 class="mb-1 mt-2 text-xl font-medium text-gray-900 dark:text-white p-4">{{ $form->name }}</h5>

                <div class="border rounded-md p-4 w-full mx-auto max-w-2xl">
                    <h4 class="text-xl lg:text-2xl font-semibold">
                        Selecciona el tamaño
                    </h4>

                    <div>
                        <label class="flex bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3  hover:bg-indigo-300 cursor-pointer ">
                             <input type="radio" name="selectedSize" value="small" wire:model.live="selectedSize">
                             <i class="pl-2">Chica</i>
                        </label>

                        <label class="flex bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3  hover:bg-indigo-300 cursor-pointer ">
                              <input type="radio" name="selectedSize" value="medium" wire:model.live="selectedSize">
                              <i class="pl-2">Mediana</i>
                         </label>

                        <label class="flex bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3  hover:bg-indigo-300 cursor-pointer ">
                              <input type="radio" name="selectedSize" value="large" wire:model.live="selectedSize">
                              <i class="pl-2">Grande</i>
                        </label>

                    </div>
                </div>

                <div class="form-control p-4">
                  <label class="label cursor-pointer">
                    <span class="label-text">Mitad y Mitad</span>
                    <input type="checkbox" wire:model.live="half" class="checkbox checkbox-primary" />
                  </label>
                </div>

                @if($half)
                    <h5 class="mb-1 mt-2 text-xl font-medium text-gray-900 dark:text-white p-4">Primer mitad: {{ $form->name }}</h5>
                @endif

                <div class="w-40 text-xl font-semibold mt-2">

                    @foreach($ingredientsList as $ingredient)
                        <div class="flex items-center space-x-2 rounded p-2 hover:bg-gray-100 accent-teal-600">
                            <!-- Verifica si el ingrediente está seleccionado -->
                            <input 
                                type="checkbox" 
                                id="{{ $ingredient->id }}" 
                                name="ingredients[]" 
                                class="h-4 w-4 rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-50 focus:ring-offset-0 disabled:cursor-not-allowed disabled:text-gray-400" 
                                value="{{ $ingredient->id }}"
                                wire:model.live="selectedIngredients" 
                            />
                            <label for="{{ $ingredient->id }}" class="flex w-full space-x-2 text-sm"> 
                                {{ $ingredient->name }} 
                            </label>
                        </div>
                    @endforeach
                </div>

                @if($half)


                    <h5 class="mb-1 mt-2 text-xl font-medium text-gray-900 dark:text-white p-4">Segunda mitad: </h5>

                    <div class="w-40 text-xl font-semibold mt-2">
                    {{-- @json($selectedIngredients) --}}

                        @foreach($ingredientsListSecond as $ingredientSecond)
                            <div class="flex items-center space-x-2 rounded p-2 hover:bg-gray-100 accent-teal-600 ">
                                <!-- Verifica si el ingrediente está seleccionado -->
                                <input 
                                    type="checkbox" 
                                    id="{{ $ingredientSecond->id }}" 
                                    name="ingredientsSecond[]" 
                                    class="h-4 w-4 rounded border-primary-300 text-teal-600 shadow-sm focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-50 focus:ring-offset-0 disabled:cursor-not-allowed disabled:text-primary-400" 
                                    value="{{ $ingredientSecond->id }}"
                                    :key="{{ $ingredient->id }}.ingredientsSecond"
                                    wire:model.live="selectedIngredientsSecond" 
                                />
                                <label for="{{ $ingredientSecond->id }}.ingredientsSecond" class="flex w-full space-x-2 text-sm"> 
                                    {{ $ingredientSecond->name }} 
                                </label>
                            </div>
                        @endforeach
                    </div>

                @endif

                <div class="w-40 text-xl font-semibold mt-2">
                    {{-- @json($selectedIngredients) --}}
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" disabled wire:model="getPrice">
                </div>

                <div class="flex mt-4 md:mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">Agregar</button>
                </div>
            </div>
        </form>
    {{-- </div> --}}
</div>
