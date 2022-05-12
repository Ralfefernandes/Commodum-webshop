<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Processing;
use App\Models\Product;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
        return view('pages.checkout');
        } else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->get('product_id')) {
            return [
                'message' => 'Cart items returned',
                'items' => Cart::where('user_id', auth()->user()->id)->sum('quantity'), // check user cart items
            ];
            
        }

        // Getting Product details
        $product = Product::where('id', $request->get('product_id'))->first();
        $productFoundInCart = Cart::where('product_id', $request->get('product_id'))
            ->pluck('id');

        if ($productFoundInCart->isEmpty()) {
            //Add product in cart.
            $cart = Cart::create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->sale_price,
                'user_id' => auth()->user()->id,
            ]);
        }
        //Incrementing Product
        else {
            $cart = Cart::where('product_id', $request->get('product_id'))
                ->increment('quantity');
        }
        if ($cart) {
            return [
                'message' => 'Cart updated',
                'items' => Cart::where('user_id', auth()->user()->id)->sum('quantity'), // check user cart items
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCartItemsForCheckout()
    {
        // Get user cart user id
        $cartItems = Cart::with('product')->where('user_id', auth()->user()->id)->get();
        $finalData = [];
        $amount = 0;
        if (isset($cartItems)) {
            foreach ($cartItems as $cartItem) {
                if ($cartItem->product) {
                    foreach ($cartItem->product as $cartProduct) {
                        if ($cartProduct->id == $cartItem->product_id) {
                            $finalData[$cartItem->product_id]['id'] = $cartProduct->id;
                            $finalData[$cartItem->product_id]['name'] = $cartProduct->name;
                            $finalData[$cartItem->product_id]['quantity'] = $cartItem->quantity;
                            $finalData[$cartItem->product_id]['sale_price'] = $cartItem->price;
                            $finalData[$cartItem->product_id]['total'] = $cartItem->price * $cartItem->quantity;
                            $amount += $cartItem->price * $cartItem->quantity;
                            $finalData['totalAmount'] = $amount;
                        }
                    }
                }
            }
        }
        return response()->json($finalData);
    }
    public function processPayment(Request $request)
    {      
         $firstName = $request->get('firstName');
         $lastName = $request->get('lastName');
         $address = $request->get('address');
         $city = $request->get('city');
         $zipCode = $request->get('zipCode');
         $email = $request->get('email');
         $phone = $request->get('phone');
         $country = $request->get('country');
         $cardType = $request->get('cardType');
         $expirationMonth = $request->get('expirationMonth');
         $expirationYear = $request->get('expirationYear');
         $verzendDatum = $request->get('verzendDatum');
         $cvv = $request->get('cvv');
         $cardNumber = $request->get('cardNumber');
         $amount = $request->get('amount');
         $orders = $request->get('order');
         $ordersArray = [];

         // getting orders details
         foreach($orders as $order)
         {
             if(isset($order['id']))
             {
                 $ordersArray[$order['id']]['order_id'] = $order['id'];
                 $ordersArray[$order['id']]['quantity'] = $order['quantity'];
 
             }
            // dd($order, $ordersArray);

         }


         // process payment

          $stripe = Stripe::make(env('STRIPE_KEY'));

          $token = $stripe->tokens()->create([
             'card' => [
                     'number' => $cardNumber,
                     'exp_month' => $expirationMonth,
                     'exp_year' => $expirationYear,
                     'cvc' => $cvv,
                 ]
             ]);
             if(!$token['id'])
             {
                 session()->flush('error', 'Stripe token generation failed');
                 return;
             }
            // create a customer Stripe
 // Create a customer Stripe
         $customer = $stripe->customers()->create([
             'name' => $firstName. ''.$lastName,
             'email' => $email,
             'phone' => $phone,
             
             'address' => [
                 'line1' => $address,
                 'postal_code' => $zipCode,
                 'city' => $city,
                 'country' => $country,
             ],

             'shipping' => [
                 'name' => $firstName.' '.$lastName,
                 'address' => [
                 'line1' => $address,
                 'postal_code' => $zipCode,
                 'city' => $city,
                 'country' => $country,
                 ],
             ],
            'source' => $token['id'],
             ]);
             // Code for chargin the client in Stripe
             $charge = $stripe->charges()->create([
                 'customer' => $customer['id'],
                 'currency' => 'eur',
                 'amount' => $amount,
                 'description' => 'Betaling van de bestelling',
               // 'total' => items.totalAmount,
         ]);
         if($charge['status'] =='succeeded')
         {
             // capture the datails from Stripe
             $customerIdStripe = $charge['id'];
             $amountRec = $charge['amount'];
             $client_id = auth()->user()->id;
 
             $processingDetails = Processing::create([
                 'client_id' => $client_id,
                 'client_name' => $firstName. ''.$lastName,
                 'client_address' => json_encode([
                                         'line1' => $address,
                                         'postal_code' => $zipCode,
                                         'city' => $city,
                                         'country' => $country,
                                     ]),
                                     'delivery_estimate' => $verzendDatum,


                 'order_details' => json_encode($ordersArray),
                 'amount' => $amount,
                 'currency' => $charge['currency'],
 
             ]);
             dd($processingDetails);
             if($processingDetails)
             {
                 // clear the cart after payment success
                 Cart::where('user_id', $client_id)->delete();
 
                 return ['success' => 'Order Completed successfully'];
             }
         }
         else {
             return ['error' => 'Order Failed contact support'];
         }
    }
}
