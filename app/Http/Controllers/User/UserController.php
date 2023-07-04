<?php

namespace App\Http\Controllers\User;

use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // home page
    public function home(){
        $product=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();

        $order=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','order'));
    }
    //contact page
    public function contactPage(){
        return view('user.main.contact');
    }
    //contact data
    public function contact(Request $request){
        $this->contactValidationCheck($request);
        $data=$this->getContactData($request);
        Contact::create($data);
        return redirect()->route('user#contactPage');
    }
    // category filter
    public function filter($id){
        $product=Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $category=Category::get();

        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $order=Order::get();
        return view('user.main.home',compact('product','category','cart','order'));
    }
    // change password page
    public function changePasswordPage(){

        return view('user.password.change');
    }
    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user=User::select('password')
                    ->where('id',Auth::user()->id)->first();
        $dbPassword=$user->password;
        if(Hash::check($request->oldPassword,$dbPassword)){
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return back()->with(['changePassword'=>'Password change successful']);
        }else{
            return back()->with(['notMatch'=>'The old password does not match.Try again.']);
        }
    }
    //account edit page
    public function editPage(){
        return view('user.account.edit');
    }

    //update account
    public function update(Request $request,$id){
        $this->accountValidationCheck($request);
        $data=$this->accoutUpdateData($request);
        if($request->hasFile('image')){
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image;
            if($dbImage!=null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Account Update Success....']);
    }
    // pizza detail page
    public function detail($id){
        $product=Product::where('id',$id)->first();
        $productList=Product::get();
        return view('user.main.detail',compact('product','productList'));
    }
    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
         'oldPassword' =>'required|min:6|max:10' ,
         'newPassword'=>'required|min:6|max:10',
         'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'image'=>'mimes:png,jpg,jpeg,webp',
            'gender'=>'required'
        ])->validate();
    }
    //account update data
    private function accoutUpdateData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'updated_at'=>Carbon::now()
        ];
    }
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'userName'=>'required',
            'email'=>'required',
            'message'=>'required'
        ])->validate();
    }
    private function getContactData($request){
        return [
            'name'=>$request->userName,
            'email'=>$request->email,
            'message'=>$request->message,
            'updated_at'=>Carbon::now()

        ];
    }
}
