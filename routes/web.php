<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['admin_auth'])->group(function(){
    // login page
Route::redirect('/', 'loginPage', 301);
Route::get('loginPage', [AuthController::class, 'login'])->name('Auth#loginPage');
// register Page
Route::get('registerPage', [AuthController::class, 'Register'])->name('Auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // admin
    Route::middleware(['admin_auth'])->group(function(){
        //account
        Route::group(['prefix'=>'account'],function(){
            // change password page
            Route::get('changePassword/page',[AdminController::class,'changePasswordPage'])->name('account#changePasswordPage');
            // password change
            Route::post('changePassword',[AdminController::class,'changePassword'])->name('account#changePassword');
            // account Profile Page
            Route::get('acount/profile',[AdminController::class,'acountProfile'])->name('account#acountProfile');
            //edit account
            Route::get('edit', [AdminController::class, 'edit'])->name('account#edit');
            //account update
            Route::post('update/{id}', [AdminController::class, 'update'])->name('account#update');
            // admin list
            Route::get('admin/list', [AdminController::class, 'adminList'])->name('account#adminList');
            //admin account delete
            Route::get('admin/delete/{id}', [AdminController::class,'deleteAccount'])->name('account#adminDelete');
            // admin role change Page
            Route::get('admin/change/rolePage/{id}', [AdminController::class,'changeRole'])->name('account#adminChangeRole');
            //change role
            Route::post('admin/change/role/{id}', [AdminController::class,'change'])->name('account#changeRole');

        });
        // category
    Route::group(['prefix'=>'category'],function(){
        // list Page
        Route::get('list', [CategoryController::class, 'list'])->name('category#list');
        //create Page
        Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
        //category create
        Route::post('create', [CategoryController::class, 'create'])->name('category#create');
        //category delete
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
        //category edit page
        Route::get('edit/{id}',[CategoryController::class,'editPage'])->name('category#editPage');
        //category update
        Route::post('update',[CategoryController::class,'update'])->name('category#update');

    });
    //product
    Route::group(['prefix'=>'product'],function(){
        // list page
        Route::get('list/page',[ProductController::class,'listPage'])->name('product#pizzaListPage');
        //create page
        Route::get('create/page',[ProductController::class,'createPage'])->name('product#pizzaCreatePage');
        //pizza create
        Route::post('create',[ProductController::class,'pizzaCreate'])->name('product#pizzaCreate');
        //pizza delete
        Route::get('delete/{id}',[ProductController::class,'pizzaDelete'])->name('product#deletePizza');
        //pizza edit page
        Route::get('details/{id}',[ProductController::class,'detailPage'])->name('product#detailsPage');
        //pizza update page
        Route::get('update/page/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
        //pizza update
        Route::post('update',[ProductController::class,'updatePizza'])->name('product#update');
     });



    });

    //user
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
       Route::get('home',[UserController::class,'home'])->name('user#home');

    });
});

