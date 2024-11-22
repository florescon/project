<?php

namespace App\Http\Controllers;

use App\Models\Shop\Category;
use App\Models\Post;
use App\Models\Shop\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index()
    {

        $categories = Cache::remember('categories', now()->addDays(3), function () {
            return Category::whereHas('products', function ($query) {
                $query->visible();
            })->take(10)->get();
        });

        return view(
            'products.index',
            [
                'categories' => $categories
            ]
        );
    }

    public function show(Product $product)
    {
        return view(
            'products.show',
            [
                'product' => $product
            ]
        );
    }
}
