<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // cart list page
    public function list(){
        $cart=Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image','products.id as product_id')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)
        ->get();
        $total=0;
        foreach($cart as $c){
            $total+=$c->pizza_price * $c->qty;
        }

        return view('user.cart.list',compact('cart','total'));
    }
    // history page
    public function history(){
        $order=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')
        ->paginate(6);
        return view('user.cart.history',compact('order'));
    }
}
