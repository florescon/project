<?php

namespace App\Livewire;

use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\CartManagement;
use App\Livewire\Partials\CountCart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Collection;

class ProductList extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';

    #[Url()]
    public $popular = false;

    public $selectedProduct = null;

    public $page = 1;
    public $perPage = 3;
    public $hasMorePages = false;
    public $allProducts; // Colección para acumular productos
    
    public function mount()
    {
        $this->allProducts = new Collection();
        $this->loadProducts();
    }

    public function setSort($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    public function updatedPopular()
    {
        $this->resetPage();
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

    public function resetPage()
    {
        $this->page = 1;
        $this->allProducts = new Collection();
        $this->loadProducts();
    }
    
    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }

    public function loadProducts()
    {
        $newProducts = Product::with('categories')
            ->when($this->activeCategory, function ($query) {
                $query->withCategory($this->category);
            })
            ->when($this->popular, function ($query) {
                $query->popular();
            })
            ->where('is_visible', true)
            ->where('is_local', false)
            ->search($this->search)
            ->orderBy('created_at', $this->sort)
            ->paginate($this->perPage, ['*'], 'page', $this->page);
            
        $this->hasMorePages = $newProducts->hasMorePages();
        
        // Concatenamos los nuevos productos a los existentes
        $this->allProducts = $this->allProducts->concat($newProducts->items());
    }

    #[Computed()]
    public function products()
    {
        $products = Product::with('categories')
            ->when($this->activeCategory, function ($query) {
                $query->withCategory($this->category);
            })
            ->when($this->popular, function ($query) {
                $query->popular();
            })
            ->where('is_visible', true)
            ->where('is_local', false)
            ->search($this->search)
            ->orderBy('created_at', $this->sort)
            ->paginate($this->perPage, ['*'], 'page', $this->page);
            
        $this->hasMorePages = $products->hasMorePages();
        
        return $products;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    #[On('load-more')]
    public function loadMore()
    {
        if ($this->hasMorePages) {
            $this->page++;
            $this->loadProducts();
        }
    }
    #[Computed()]
    public function activeCategory()
    {
        if ($this->category === null || $this->category === '') {
            return null;
        }

        return Category::where('slug', $this->category)->first();
    }

    public function render()
    {
        return view('livewire.product-list',[
            'categories' => Category::all(),
        ]);
    }
}
