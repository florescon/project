<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PizzaController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Products\ProductShow;
use App\Livewire\CartPage;
use App\Models\User;
 
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrderPage;
use App\Livewire\SuccessPage;
use App\Livewire\CancelPage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'email_verified_at' => now(),
    ]);
 
    Auth::login($user);
 
    return redirect()->to('/');
});


Route::get('/facebook-auth/redirect', function () {
    return Socialite::driver('facebook')->redirect();
});
 
Route::get('/facebook-auth/callback', function () {
    $googleUser = Socialite::driver('facebook')->stateless()->user();

    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'email_verified_at' => now(),
    ]);
 
    Auth::login($user);
 
    return redirect()->to('/');
});

Route::get('/deletion', [GeneralController::class, 'deletion'])->name('deletion');

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/product', [ProductController::class, 'index'])->name('products.index');

Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/productqr/{product:slug}', [ProductController::class, 'qr'])->name('products.qr');


Route::get('/pizza', [PizzaController::class, 'index'])->name('pizzas.index');


Route::get('/cart', CartPage::class)->name('cart');

Route::get('/language/{locale}', function ($locale) {
    if (array_key_exists($locale, config('app.supported_locales'))) {
        session()->put('locale', $locale);
    }

    return redirect()->back();
})->name('locale');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/checkout', CheckoutPage::class);
    Route::get('/my-orders', MyOrderPage::class)->name('my-orders.index');
    Route::get('/my-orders/{order:number}', MyOrderDetailPage::class)->name('my-orders.show');
    
    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});
