<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     // password change page
     public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    //password change
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
    // account profile
    public function acountProfile(){
        return view('admin.account.profile');
    }
    //edit account
    public function edit(){
        return view('admin.account.edit');
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
        return redirect()->route('account#acountProfile')->with(['updateSuccess'=>'Account Update Success....']);
    }
    // admin list
    public function adminList(){
        $admin=User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                ->orWhere('email','like','%'.request('key').'%')
                ->orWhere('gender','like','%'.request('key').'%')
                ->orWhere('phone','like','%'.request('key').'%')
                ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role', 'admin')->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.adminList',compact('admin'));
    }
    // user list page
    public function userList(){
        $user=User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                ->orWhere('email','like','%'.request('key').'%')
                ->orWhere('gender','like','%'.request('key').'%')
                ->orWhere('phone','like','%'.request('key').'%')
                ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','user')
        ->paginate(4);

        $user->appends(request()->all());
        return view('admin.account.userList',compact('user'));
    }
    //user ajax
    public function userAjax(Request $request){
       $user= User::where('id',$request->userId)->update(['role' =>$request->role]);

    }
    // admin delete account
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account delete successfully']);
    }
    // user delete account
    public function deleteUserAccount($id){
    User::where('id',$id)->delete();
    return back()->with(['deleteSuccess'=>'User Account delete successfully']);
}
    // change  admin role
    public function adminAjax(Request $request){
        $user= User::where('id',$request->adminId)->update(['role' =>$request->role]);
    }
    public function contactPage(){
        $contact=Contact::orderBy('created_at','desc')->paginate(4);
        $contact->appends(request()->all());
        return view('admin.account.contactList',compact('contact'));
    }



    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'image'=>'mimes:png,jpg,jpeg',
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
    // password validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
         'oldPassword' =>'required|min:6|max:10' ,
         'newPassword'=>'required|min:6|max:10',
         'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
