<?php
namespace App\Helpers;

use App\Models\Shop\Product;
use App\Models\Shop\Speciality;
use Illuminate\Support\Facades\Cookie;

class CartManagement {
    // add item to cart
    static public function addItemsToCart($product_id, ?bool $is_speciality = false, ?int $priceGet = 1, ?string $size = null, ?array $ingredients = [], ?array $nameIngredients = [], ?bool $half = false, ?array $ingredientsSecond = [], ?array $nameIngredientsSecond = []) {

        $folio = now()->format('dmyHi') . random_int(1000, 9999) . random_int(1, 9);

        $cart_items = self::getCartItemsFromCookie();
        
        $existing_item = null; 
        
        foreach ($cart_items as $key => $item) {
            if($item['shop_product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }
        
        if(($existing_item !== null) && ($is_speciality == false)) {
            $cart_items[$existing_item]['qty']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['qty'] * $cart_items[$existing_item]['unit_price'];
            $cart_items[$existing_item]['unit_price'];
        } else {
            if($is_speciality == true){
                $speciality = Speciality::where('id', $product_id)->first(['id', 'name', 'price_small']);

                if($half){
                    $properties = [
                        'speciality_id' => $product_id,
                        'ingredients' => $ingredients,
                        'speciality_id_second' => count($ingredientsSecond) ? '25' : '',
                        'ingredients_second' => $ingredientsSecond,
                    ];
                }
                else{
                    $properties = [
                        'speciality_id' => $product_id,
                        'ingredients' => $ingredients,
                    ];
                }

                if($speciality) {
                    $cart_items[] = [
                        'folio'=> $folio,
                        'shop_product_id' => $product_id,
                        'name' => $speciality->name,
                        // 'image' => $speciality->image[0] ?? null,
                        'quantity' => 1,
                        'size' => $size,
                        'ingredients' => $ingredients,
                        'nameIngredients' => $nameIngredients,
                        'ingredients_second' => $ingredientsSecond,
                        'nameIngredientsSecond' => $nameIngredientsSecond,
                        'properties' => $properties,
                        'unit_price' => $priceGet,
                        'choose' => $half ? 'half' : 'complete',
                        'total_amount' => $priceGet,
                        'is_speciality' => true,
                    ];
                }
            }
            else{
                $product = Product::where('id', $product_id)->first(['id', 'name', 'price']);
                if($product) {
                    $cart_items[] = [
                        'folio'=> $folio,
                        'shop_product_id' => $product_id,
                        'name' => $product->name,
                        // 'image' => $product->image[0] ?? null,
                        'qty' => 1,
                        'unit_price' => $product->price,
                        'total_amount' => $product->price,
                        'is_speciality' => false,
                    ];
                }
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
        
    }

    // add items to cart with qty
    static public function addItemsToCartWithQty($product_id, $qty = 1) {
        $cart_items = self::getCartItemsFromCookie();
        
        $existing_item = null;
        
        foreach ($cart_items as $key => $item) {
            if($item['shop_product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }
        
        if($existing_item !== null) {
            $cart_items[$existing_item]['qty'] = $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['qty'] * $cart_items[$existing_item]['unit_price'];

            $cart_items[$existing_item]['unit_price'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'image', 'price']);
            if($product) {
                $cart_items[] = [
                    'shop_product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->image[0],
                    'qty' => $qty,
                    'unit_price' => $product->price,
                    'total_amount' => $product->price,
                    'is_speciality' => false,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
        
    }



    // remove item to cart
    static public function removeCartItem($folio) {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if($item['folio'] == $folio) {
                unset($cart_items[$key]);
            }
        }

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
        
    }
    // add cart items to cookie
    static public function addCartItemsToCookie($cart_items) {
        Cookie::queue('cart_items', json_encode($cart_items), 30);
        /* 
            Buat Cookie dengan Nama cart_items
            dan buat jadi expired setiap 30 hari

            json_encode mengonversi data(array atau objek) ke string JSON
            CONTOH:
            {"nama":"John","umur":25,"hobi":["membaca","berenang"]}
        */
    }


    // clear cart items from cookie
    static public function clearCartItems() {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // get all cart items from cookie
    static public function getCartItemsFromCookie() {
        $cart_items = json_decode(Cookie::get('cart_items'), true);

        if(!$cart_items) {
            $cart_items = [];
        }

        return $cart_items;

        /* 
            json_Decode mengonversi string JSON ke data(array atau objek)
             
            Jika Cookie cart_items tidak ada, buat cart_items kosong

            mengembalikan array
        */
    }
    
    // increase item quantity
    static public function incrementQuantityToCartItem($product_id) {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['shop_product_id'] == $product_id) {
                // Comprobar si el campo 'qty' o 'quantity' existe y luego incrementar
                if (isset($item['qty'])) {
                    $cart_items[$key]['qty']++;
                } elseif (isset($item['quantity'])) {
                    $cart_items[$key]['quantity']++;
                }

                // Recalcular el total
                $cart_items[$key]['total_amount'] = (float)($cart_items[$key]['qty'] ?? $cart_items[$key]['quantity']) * (float)$cart_items[$key]['unit_price'];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }
    
    // Decrease item quantity
    static public function decrementQuantityToCartItem($product_id) {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['shop_product_id'] == $product_id) {
                // Verificar si 'qty' o 'quantity' está disponible y decrementarlo
                if (isset($item['qty']) && $cart_items[$key]['qty'] > 1) {
                    $cart_items[$key]['qty']--;
                } elseif (isset($item['quantity']) && $cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity']--;
                }

                // Recalcular el total
                $cart_items[$key]['total_amount'] = (float)($cart_items[$key]['qty'] ?? $cart_items[$key]['quantity']) * (float)$cart_items[$key]['unit_price'];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    
    // calculate grand total
    static public function calculateGrandTotal($items) {
        return array_sum(array_column($items, 'total_amount'));
    }

}

