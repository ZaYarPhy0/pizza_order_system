<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function home(){
        $product=Product::get();
        return view('user.main.home',compact('product'));
    }
}
