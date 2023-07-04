<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function data(Request $request){
        if($request->status=='asc'){
            $data=Product::orderBy('created_at','asc')->get();

        }else if($request->status=='desc'){
            $data=Product::orderBy('created_at','desc')->get();
        }
        return response()->json($data,200);
    }

    public function pizzaCount(Request $request){
        $data=$this->getPizzaCountData($request);
        Cart::create($data);
        $response=[
            'status' =>'success',
            'message' =>'add to cart complete'
        ];
        return response()->json($response,200);
    }
    // prduct order
    public function order(Request $request){
        $total=0;
        foreach($request->all() as $item){
            $data=OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total'=>$item['total'],
                'order_code' => $item['order_code']
            ]);
            $total+=$data->total;
        }
        Cart::where('user_id', Auth::user()->id)->delete();
        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->order_code,
            'total_price'=>$total+3000
        ]);
        $response=[
            'status' =>'success',
            'message' =>'Order completed'
        ];
        return response()->json($response,200);
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id', Auth::user()->id)->delete();
    }
    //clear product
    public function clearProduct(Request $request){
        Cart::where('user_id', Auth::user()->id)
        ->where('product_id', $request->productId)
        ->where('id', $request->orderId)
        ->delete();

    }
    // view count
    public function viewCount(Request $request){
       $product= Product::where('id', $request->productId)->first();
       $data=['view_count'=>$product->view_count + 1];
       Product::where('id',$request->productId)->update($data);
    }

    private function getPizzaCountData($request){
        return [
            'product_id' => $request->pizzaId,
            'qty' => $request->pizzaCount,
            'user_id' => $request->userId,
            'created_at'=>Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
