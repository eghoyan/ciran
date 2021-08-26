<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use \App\Models\Product;
use \App\Models\Shop;

class PaymentController extends Controller
{
    public function payment(Request $request){

		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $product = Product::find($request->id);
 
        $shop = new Shop();
        $shop->user_id = Auth::user()->id;
        $shop->product_id = $product->id;
        $shop->status = Shop::UNPAID;
        $shop->save();

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' =>(float)$product->price*100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://127.0.0.1:8000/payment/success/'.$shop->id,
            'cancel_url' => 'http://127.0.0.1:8000/payment/cancel',
        ]);
        return response()->json(['status' =>true,'id' => $session->id]);
    }

    public function success($id) {

        $shop = Shop::find($id);
        $shop->status = Shop::PAID;
        $shop->save();
        
        $product = Product::find($shop->product_id);
        $product->quantity = $product->quantity -1;
        $product->save();

        toastr()->success('vjarum@ hajoxutyamb katarvec');
        return Redirect::to(route('user.product'));
    }

    public function cancel() {
        toastr()->error('vjarum@ merjvec');
        return Redirect::to(route('user.product'));
    }
}
