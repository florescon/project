<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\CountCart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CartPage extends Component
{
    use LivewireAlert;
    #[Title('Cart Page')]

    public $cart_items = [];
    public $grand_total;

    public function mount() {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function increaseQty($product_id) {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQty($product_id) {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($folio) {
        $this->cart_items = CartManagement::removeCartItem($folio);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

         $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(CountCart::class);

         $this->alert('success', '¡Producto eliminado!', [
             'position' => 'top',
             'timer' => 3000,
             'toast' => true,
            ]);
    }

    public function render()
    {
        $product_items = collect($this->cart_items)->filter(function($item) {
            return $item['is_speciality'] === false;
        });

        $speciality_items = collect($this->cart_items)->filter(function($item) {
            return $item['is_speciality'] === true;
        });

        return view('livewire.cart-page', [
            'speciality_items' => $speciality_items,
            'product_items' => $product_items,
        ]);
    }
}
