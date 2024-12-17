<?php

namespace App\Livewire\Forms;

use App\Models\Shop\Speciality;
use Livewire\Form;
use Illuminate\Validation\Rule;

class PizzaForm extends Form
{
    public ?Speciality $pizza = null;

    public string $name = '';
    public string $notes = '';
    public $price_small;
    public $price_medium;
    public $price_large;
    public $ingredients = [];

    public function setPizza(?Speciality $pizza = null): void
    {
        $this->pizza = $pizza;
        $this->name = $pizza->name;
        $this->notes = $pizza->notes ?? '';
        $this->price_small = $pizza->price_small;
        $this->price_medium = $pizza->price_medium;
        $this->price_large = $pizza->price_large;
        $this->ingredients = $pizza->ingredients;
    }

    public function save(): void
    {
        $this->validate();

        if (empty($this->pizza)) {
            Speciality::create($this->only(['name', 'notes']));
        } else {
            $this->pizza->update($this->only(['name', 'notes']));
        }

        $this->reset();
    }

    public function rules(): array
    {
        return [
            'name'        => [
                'required',
                Rule::unique('shop_specialties', 'name')->ignore($this->component->pizza),
            ],
            'notes' => [
                'required'
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'notes' => 'notes',
        ];
    }
}
