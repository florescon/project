<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Shop\Order;
use App\Models\Shop\OrderItem;
use App\Models\Shop\OrderPizza;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('My Order Detail')]
class MyOrderDetailPage extends Component
{
    public $order_id;
    public $number;

    public function mount(Order $order) {
        $this->number = $order->number;
    }

    public function render()
    {
        $order = Order::where('number', $this->number)->first();

        if (!$order || $order->user_id !== auth()->id()) {
            abort(401, 'Unauthorized'); // Devuelve un error 401 si no corresponde
        }

        $order_items = OrderItem::where('shop_order_id', $order->id)->get();
        $address = $order->address_id ? Address::whereId($order->address_id)->first() : '';

        $order_pizzas = OrderPizza::where('shop_order_id', $order->id)->get();

        return view('livewire.my-order-detail-page', [
            'order_items' => $order_items,
            'order_pizzas' => $order_pizzas,
            'address' => $address,
            'order' => $order
        ]);
    }
}
