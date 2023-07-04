<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order list page
    public function orderPage(){
        $order=Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->orderBy('created_at','desc')
        ->when(request('key'),function($query){
            $query->orWhere('orders.order_code','like','%'.request('key').'%')
            ->orWhere('users.name','like','%'.request('key').'%')
            ->orWhere('orders.user_id','like','%'.request('key').'%');
        })
        ->get();
        return view('admin.order.list',compact('order'));
    }
    //order ajax
    public function orderStatus(Request $request){
        $order=Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->orderBy('created_at','desc')
        ->when(request('key'),function($query){
            $query->orWhere('orders.order_code','like','%'.request('key').'%')
            ->orWhere('users.name','like','%'.request('key').'%')
            ->orWhere('orders.user_id','like','%'.request('key').'%');
        });
        if($request->searchStatus==null){
            $order=$order->get();
        }else{
            $order=$order->where('orders.status',$request->searchStatus)
            ->get();
        }

        return view('admin.order.list',compact('order'));
    }
    //order code list page
    public function orderCodePage($orderCode){
        $order=Order::where('order_code',$orderCode)->first();
        $orderList=OrderList::where('order_code',$orderCode)
        ->select('order_lists.*','products.image as product_image','products.name as product_name','users.name as user_name')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->paginate(3);
        return view('admin.order.orderCode',compact('orderList','order'));
    }
    //order status change
    public function orderStatusChange(Request $request){
        Order::where('id',$request->orderId)->update([
            'status'=>$request->status
        ]);
        $data=['message'=>'success'];

        return response()->json($data,200);
    }
}
