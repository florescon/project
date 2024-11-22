<?php

namespace App\Livewire;

use App\Models\Shop\Product;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeButtonProduct extends Component
{
    public Product $product;

    public function toggleLike()
    {
        if (auth()->guest()) {
            return $this->redirect(route('login'), true);
        }

        $user = auth()->user();

        if ($user->hasLikedProduct($this->product)) {
            $user->likes_product()->detach($this->product);
            return;
        }

        $user->likes_product()->attach($this->product);
    }


    public function render()
    {
        return view('livewire.like-button-product');
    }
}
