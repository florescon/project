<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Shop\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $featuredProducts = Cache::remember('featuredProducts', now()->addDay(), function () {
            return Product::visible()->popular()->with('categories')->take(3)->get();
        });

        $latestProducts = Cache::remember('latestProducts', now()->addDay(), function () {
            return Product::visible()->with('categories')->latest('created_at')->take(9)->get();
        });

        return view('home', [
            'featuredProducts' => $featuredProducts,
            'latestProducts' => $latestProducts
        ]);
    }
}
