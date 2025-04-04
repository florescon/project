<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Shop\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $number_address;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method;
    
    public $number;

    public function mount() {
        $this->number = 'OR-' . now()->format('dmy-Hi') . '-' . random_int(1000, 9999);

        $cart_items = CartManagement::getCartItemsFromCookie();

        if(count($cart_items) == 0  ) {
            return redirect()->route('products.index');
        }
    }

    public function checkout()
    {

        // dd(CartManagement::getCartItemsFromCookie());
        $this->validate([
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'phone' => 'required',
            // 'street_address' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'zip_code' => 'required',
            'payment_method' => 'required',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();

        $non_speciality_items = array_filter($cart_items, function($item) {
            return $item['is_speciality'] === false;
        });

        $speciality_items = array_filter($cart_items, function($item) {
            return $item['is_speciality'] === true;
        });

        // dd($speciality_items);


        $line_items = [];

        foreach ($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'unit_price' => $item['unit_price'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ]
                ],
                'qty' => ($item['qty'] ?? '0') + ($item['quantity'] ?? '0'),
            ];
        }

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->number = $this->number;
        $order->total_price = CartManagement::calculateGrandTotal($cart_items);
        // $order->payment_method = $this->payment_method;
        // $order->payment_status = 'pending';
        $order->status = 'new';
        $order->shipping_price = 0;
        $order->shipping_method = 'none';
        $order->currency = 'mxm';
        $order->priority = 'medium';
        $order->address_id = null;
        $order->notes = 'Order created by ' . auth()->user()->name;

        // $address = new Address();
        // $address->first_name = $this->first_name;
        // $address->last_name =  $this->last_name;
        // $address->phone = $this->phone;
        // $address->street_address = $this->street_address;
        // $address->city = $this->city;
        // $address->state = $this->state;
        // $address->zip_code = $this->zip_code;

        $redirect_url ='';

        if($this->payment_method =='stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout =  Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'),

            ]);

            $redirect_url = $sessionCheckout->url;
        } else {
            $redirect_url = route('success');
        }
        $order->save();
        
        // $address->order_id = $order->id;
        // $address->save();

        $order->items()->createMany($non_speciality_items);
        $order->pizzas()->createMany($speciality_items);
        CartManagement::clearCartItems();
        // Mail::to(request()->user())->send(new OrderPlaced($order));
        return redirect($redirect_url);
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
