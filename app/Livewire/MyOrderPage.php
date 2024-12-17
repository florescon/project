<?php

namespace App\Livewire;

use App\Models\Shop\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('My Order')]
class MyOrderPage extends Component
{
    use WithPagination;
    
    public function render()
    {
        $my_order = Order::with('items', 'pizzas')->where('user_id', auth()->id())->latest()->paginate(5);
        return view('livewire.my-order-page', [
            'orders' => $my_order,
        ]);
    }
}
