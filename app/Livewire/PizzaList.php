<?php

namespace App\Livewire;

use App\Models\Shop\Speciality;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\CartManagement;
use App\Livewire\Partials\CountCart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Collection;

class PizzaList extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';

    #[Url()]
    public $popular = false;

    public $page = 1;
    public $perPage = 3;
    public $hasMorePages = false;
    public $allProducts; // Colección para acumular productos

    public $sSpeciality;

    public function mount()
    {
        $this->allProducts = new Collection();
        $this->loadProducts();
    }

    public function setSort($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    public function resetPage()
    {
        $this->page = 1;
        $this->allProducts = new Collection();
        $this->loadProducts();
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

    public function clearFilters()
    {
        $this->search = '';
        $this->resetPage();
    }

    #[Computed()]
    public function pizzas()
    {
        return Speciality::with('ingredients')
            ->search($this->search)
            ->orderBy('created_at', $this->sort)
            ->paginate(3);
    }


    public function loadProducts()
    {
        $newProducts = Speciality::with('ingredients')
            ->search($this->search)
            ->orderBy('created_at', $this->sort)
            ->paginate($this->perPage, ['*'], 'page', $this->page);

        $this->hasMorePages = $newProducts->hasMorePages();

        $this->allProducts = $this->allProducts->concat($newProducts->items());
    }

    #[On('load-more')]
    public function loadMore()
    {
        if ($this->hasMorePages) {
            $this->page++;
            $this->loadProducts();
        }
    }

    #[On('refresh-list')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.pizza-list');
    }
}
