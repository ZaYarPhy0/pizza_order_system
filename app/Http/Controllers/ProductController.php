<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Storage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // pizza list page
    public function listPage(){
        $products=Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->orderBy('products.created_at','desc')
        ->paginate(3);
        $products->appends(request()->all());
        return view('admin.product.pizzaList',compact('products'));
    }
    //pizza create page
    public function createPage(){
        $categories=Category::select('id','name')->get();

        return view('admin.product.pizzaCreate',compact('categories'));
    }
    //pizza create
    public function pizzaCreate(Request $request){
        $this->productValidationCheck($request,"create");
        $data=$this->getProductData($request);
        if($request->hasFile('image')){
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;

        }
        Product::create($data);
        return redirect()->route('product#pizzaListPage')->with(['createSuccess'=>'Pizza product create successful..']);
    }

    // delete Pizza
    public function pizzaDelete($id){
        Product::where('id', $id)->delete();
        return redirect()->route('product#pizzaListPage')->with(['deleteSuccess'=>'Pizza product delete successful']);

    }
    //pizza details page
    public function detailPage($id) {
        $product=Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.pizzaEdit',compact('product'));
    }
    // pizza update page
    public function updatePage($id){
        $product=Product::where('id',$id)->first();
        $category=Category::get();
        return view('admin.product.pizzaUpdate',compact('product','category'));
    }
    public function updatePizza(Request $request){
        $this->productValidationCheck($request,"update");
        $data=$this->getProductData($request);
        if($request->hasFile('image')){
            $dbimage=Product::where('id',$request->pizzaId)->first();
            $dbimage=$dbimage->image;
            if(!$dbimage===null){
                Storage::delete('public/'.$dbimage);
            }
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#pizzaListPage')->with(['updateSuccess' => 'Pizza Update Success...']);

    }

    //get product data
    private function getProductData($request) {
        return [
            'category_id'=>$request->categoryId,
            'description'=>$request->description,
            'price'=>$request->price,
            'name'=>$request->pizzaName,
            'waiting_time'=>$request->waitingTime
        ];
    }

    //product validation
    private function productValidationCheck($request,$action){
        $validationRule=[
                'pizzaName'=>'required|unique:products,name,'.$request->pizzaId,
                'categoryId'=>'required',
                'price'=>'required',
                'waitingTime'=>'required',
                'description'=>'required'
        ];
        $validationRule['image']=$action=="create" ?'required|mimes:jpg,jpeg,png,webp|file':'mimes:jpg,jpeg,png,webp|file';
        Validator::make($request->all(),$validationRule)->validate();
    }
}
