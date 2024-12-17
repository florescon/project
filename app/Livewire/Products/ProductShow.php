<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Shop\Product;
use App\Helpers\CartManagement;
use App\Livewire\Partials\CountCart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductShow extends Component
{
    use LivewireAlert;

    public $slug;

    public function mount($slug) {
        $this->slug = $slug;
    }

    public function addToCart($product_id) {
        $total_count = CartManagement::addItemsToCart($product_id);

        // mengirimkan event bernama 'update-cart-count' dengan data total_count ke komponen Navbar.
        $this->dispatch('update-cart-count', total_count: $total_count)->to(CountCart::class);

        // menampilkan alert | library github dari https://github.com/jantinnerezo/livewire-alert?tab=readme-ov-file
        $this->alert('success', '¡Agregado!', [
            'position' => 'top',
            'timer' => 3000,
            'toast' => true,
           ]);
    }

    public function render()
    {
        return view('livewire.products.product-show',[
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
