<?php

namespace App\Livewire;

use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{

    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';

    #[Url()]
    public $popular = false;

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

    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }

    #[Computed()]
    public function products()
    {
        return Product::with('categories')
            ->when($this->activeCategory, function ($query) {
                $query->withCategory($this->category);
            })
            ->when($this->popular, function ($query) {
                $query->popular();
            })
            ->search($this->search)
            ->orderBy('created_at', $this->sort)
            ->paginate(3);
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
