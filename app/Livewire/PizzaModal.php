<?php

namespace App\Livewire;

use App\Models\Shop\Speciality;
use App\Models\Shop\Ingredient;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use App\Helpers\CartManagement;
use App\Livewire\Partials\CountCart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PizzaModal extends ModalComponent
{
    use LivewireAlert;

    public ?Speciality $pizza = null;
    public Forms\PizzaForm $form;

    public $getPrice;

    public $selectedSize;
    public $ingredientsList = [];
    public $selectedIngredients = [];  // Nueva propiedad para los ingredientes seleccionados

    public $ingredientsListSecond = [];
    public $selectedIngredientsSecond = [];  // Nueva propiedad para los ingredientes seleccionados

    public $totalPrice = 0;  // Variable para almacenar el precio total de los ingredientes

    public ?bool $half = false;

    public $selectSpeciality;
    public $specialities = []; // Para almacenar la lista de especialidades

    public $previousStatePrice;

    public function mount(Speciality $pizza = null): void
    {
        if ($pizza->exists) {
            $this->form->setPizza($pizza);
            $this->selectedIngredients = $pizza->ingredients->pluck('id')->toArray(); 
        }
        $this->ingredientsList = Ingredient::where('for_pizza', true)->orderBy('name')->get();
        $this->ingredientsListSecond = Ingredient::where('for_pizza', true)->orderBy('name')->get();

        $this->specialities = Speciality::all();

    }

    #[On('selectedSize')]
    public function updatedSelectedSize($size)
    {
        $valueFirst = $this->pizza["price_{$size}"];
        $valueSecond = 0;

        if($this->half === true){
            if((int) $this->selectSpeciality){
                $pizz = Speciality::whereId($this->selectSpeciality)->first();
                $valueSecond = $pizz["price_{$size}"] ?? 0;
            }
        }

        $this->getPrice = max($valueFirst, $valueSecond);
        return $this->updSelectedIngredients();
    }

    public function updatedSelectSpeciality()
    {
        if((int) $this->selectSpeciality){
            $this->previousStatePrice = 'second';
            $pizz = Speciality::whereId($this->selectSpeciality)->first();
            $this->selectedIngredientsSecond = $pizz->ingredients->pluck('id')->toArray(); 
            $this->updSelectedIngredientsSecond();
        }
    }

    public function updatedSelectedIngredients()
    {
        return $this->updSelectedIngredients();
    }

    public function updatedSelectedIngredientsSecond()
    {
        return $this->updSelectedIngredientsSecond();
    }

    public function updSelectedIngredientsSecond()
    {
        //Obtener los Ingredientes Originales de la Especialidad
        $getIngredientsOriginal = [];

        if((int) $this->selectSpeciality){
            $pizz = Speciality::whereId($this->selectSpeciality)->first();
            $getIngredientsOriginal = $pizz->ingredients->pluck('id')->toArray(); 
        }

        $total = 0;
        $totalIngredients = 0;

        // Si hay un tamaño seleccionado, usamos el precio correcto
        if ($this->selectedSize) {
            // Obtenemos el precio del tamaño seleccionado
            $sizeColumn = "price_{$this->selectedSize}";

            // Recorremos los ingredientes seleccionados y sumamos su precio
            foreach ($this->selectedIngredientsSecond as $ingredientId) {

                if (in_array($ingredientId, $getIngredientsOriginal)) {
                    continue; // Saltamos este ingrediente
                }

                $totalIngredients++;

                $ingredient = Ingredient::find($ingredientId);

                if ($ingredient) {
                    $total += (float) $ingredient[$sizeColumn];  // Sumar el precio del ingrediente según el tamaño
                }
            }
        }

        $actualPrice = $this->getPrice;

        $newPrice = $actualPrice; // Inicializamos el nuevo precio con el precio actual

        // dd($totalIngredients);
        // dd($sizeColumn);
        // if(($totalIngredients == 0) )

        // Si el número de ingredientes diferentes es menor a 2, asignamos un precio fijo
        if ((count($this->selectedIngredientsSecond) == 2 ) && ($totalIngredients > 0)) {
            if($sizeColumn == "price_small"){
                $newPrice = 160;
            }
            if($sizeColumn == "price_medium"){
                $newPrice = 190;
            }
            if($sizeColumn == "price_large"){
                $newPrice = 215;
            }
        }
        // Si son 3 ingredientes, asignamos otro precio fijo
        elseif ((count($this->selectedIngredientsSecond) == 3) && ($totalIngredients > 0)) {
            if($sizeColumn == "price_small"){
                $newPrice = 170;
            }
            if($sizeColumn == "price_medium"){
                $newPrice = 195;
            }
            if($sizeColumn == "price_large"){
                $newPrice = 235;
            }
        } else {
            // Si es más de 3 ingredientes, calculamos el precio según los ingredientes seleccionados
            $newPrice = $total + (float) $pizz["price_{$this->selectedSize}"];
        }

        if($this->previousStatePrice === 'second'){
            $this->getPrice = $newPrice;
        }
        else{
            if(($newPrice > $actualPrice)){
                $this->getPrice = $newPrice;
            }
        }

        $this->previousStatePrice = 'second';
    }

    public function updSelectedIngredients()
    {
        //Obtener los Ingredientes Originales de la Especialidad
        $getIngredientsOriginal = $this->form->ingredients->pluck('id')->toArray();

        $total = 0;
        $totalIngredients = 0;

        // Si hay un tamaño seleccionado, usamos el precio correcto
        if ($this->selectedSize) {
            // Obtenemos el precio del tamaño seleccionado
            $sizeColumn = "price_{$this->selectedSize}";

            // Recorremos los ingredientes seleccionados y sumamos su precio
            foreach ($this->selectedIngredients as $ingredientId) {

                if (in_array($ingredientId, $getIngredientsOriginal)) {
                    continue; // Saltamos este ingrediente
                }

                $totalIngredients++;

                $ingredient = Ingredient::find($ingredientId);

                if ($ingredient) {
                    $total += (float) $ingredient[$sizeColumn];  // Sumar el precio del ingrediente según el tamaño
                }
            }
        }
        // dd($sizeColumn);
        // if(($totalIngredients == 0) )

        $actualPrice = $this->getPrice; // Guardamos el precio actual
        $newPrice = $actualPrice; // Inicializamos el nuevo precio con el precio actual

        // Si el número de ingredientes diferentes es menor a 2, asignamos un precio fijo
        if ((count($this->selectedIngredients) == 2 ) && ($totalIngredients > 0)) {
            if($sizeColumn == "price_small"){
                $newPrice = 160;
            }
            if($sizeColumn == "price_medium"){
                $newPrice = 190;
            }
            if($sizeColumn == "price_large"){
                $newPrice = 215;
            }
        }
        // Si son 3 ingredientes, asignamos otro precio fijo
        elseif ((count($this->selectedIngredients) == 3) && ($totalIngredients > 0)) {
            if($sizeColumn == "price_small"){
                $newPrice = 170;
            }
            if($sizeColumn == "price_medium"){
                $newPrice = 195;
            }
            if($sizeColumn == "price_large"){
                $newPrice = 235;
            }
        } else {
            // Si es más de 3 ingredientes, calculamos el precio según los ingredientes seleccionados
            $newPrice = $total + (float) $this->pizza["price_{$this->selectedSize}"];
        }

        if($this->previousStatePrice === 'first'){
            $this->getPrice = $newPrice;
        }
        else{
            if(($newPrice > $actualPrice)){
                $this->getPrice = $newPrice;
            }
        }

        $this->previousStatePrice = 'first';
    }

    public function save(): void
    {   
        if((int) $this->getPrice){

            $nameIngredients = [];
            $nameIngredientsSecond = [];

            if(count($this->selectedIngredients)){
                $getIngredients = Ingredient::whereIn('id', $this->selectedIngredients)->get();
                $nameIngredients = $getIngredients->pluck('name')->toArray();
            }

            if($this->half){
                $getIngredientsSecond = Ingredient::whereIn('id', $this->selectedIngredientsSecond)->get();
                $nameIngredientsSecond = $getIngredientsSecond->pluck('name')->toArray();
            }

            $total_count = CartManagement::addItemsToCart($this->pizza->id, true, $this->getPrice, "price_".$this->selectedSize, $this->selectedIngredients, $nameIngredients, $this->half, (int) $this->selectSpeciality ?? 25, $this->selectedIngredientsSecond, $nameIngredientsSecond);
            $this->dispatch('update-cart-count', total_count: $total_count)->to(CountCart::class);

            // $this->form->save();

            $this->alert('success', '¡Agregado!', [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
               ]);
            $this->closeModal();
            $this->dispatch('refresh-list');
        }
        else{
            $this->alert('error', '¡Seleccione tamaño!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
               ]);
        }
    }

    public function render()
    {
        return view('livewire.pizza-modal');
    }
}
