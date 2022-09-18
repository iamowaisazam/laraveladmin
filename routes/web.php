<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;


// use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\SubCategoryController;
// use App\Http\Controllers\Admin\VendorController;
// use App\Http\Controllers\Admin\PurchaseOrderController;
// use App\Http\Controllers\Admin\PurchaseReceiptController;
// use App\Http\Controllers\Admin\AttributeController;
// use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\Admin\OrderController;



Route::prefix('admin')->name('admin.')->group(function () {
      
  // dd('asd');

        Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login-submit', [AuthController::class, 'login_submit'])->name('login_submit');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register-submit', [AuthController::class, 'register_submit'])->name('register_submit');

    Route::middleware(['auth'])->group(function () {
        
          Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
          
          //Users
          Route::resource('users', UserController::class);
        



          Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');


        // Route::get('login', [AuthController::class, 'login'])->name('login');      
        // Route::get('/admin/login/submit',[DashboardController::class,'login_submit'])->name('admin.login.submit');
    
    });


     //Main Dashboard
    //  Route::get('/home',[DashboardController::class,'index'])->name('home');
    //  Route::get('logout', [DashboardController::class,'logout'])->name('logout');

    //  //Categories
    //  Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
    //  Route::get('/categories/search',[CategoryController::class,'search'])->name('categories.search');
    //  Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
    //  Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store');
    //  Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
    //  Route::post('/categories/update/{id}',[CategoryController::class,'update'])->name('categories.update');
    //  Route::get('/categories/delete/{id}',[CategoryController::class,'delete'])->name('categories.delete');

    //  //SubCategory
    //  Route::get('/subcategories',[SubCategoryController::class,'index'])->name('subcategories.index');
    //  Route::get('/subcategories/create',[SubCategoryController::class,'create'])->name('subcategories.create');
    //  Route::post('/subcategories/store',[SubCategoryController::class,'store'])->name('subcategories.store');
    //  Route::get('/subcategories/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategories.edit');
    //  Route::post('/subcategories/update/{id}',[SubCategoryController::class,'update'])->name('subcategories.update');
    //  Route::get('/subcategories/delete/{id}',[SubCategoryController::class,'delete'])->name('subcategories.delete'); 
     
    //  //Vendors
    //  Route::get('/vendors',[VendorController::class,'index'])->name('vendors.index');
    //  Route::get('/vendors/search',[VendorController::class,'search'])->name('vendors.search');
    //  Route::get('/vendors/create',[VendorController::class,'create'])->name('vendors.create');
    //  Route::post('/vendors/store',[VendorController::class,'store'])->name('vendors.store');
    //  Route::get('/vendors/edit/{id}',[VendorController::class,'edit'])->name('vendors.edit');
    //  Route::post('/vendors/update/{id}',[VendorController::class,'update'])->name('vendors.update');
    //  Route::get('/vendors/delete/{id}',[VendorController::class,'delete'])->name('vendors.delete'); 
     
    //  //Products
    //  Route::get('/products',[ProductController::class,'index'])->name('products.index');
    //  Route::get('/products/article-search',[ProductController::class,'article_search'])->name('products.article_search');
    //  Route::get('/products/search',[ProductController::class,'search'])->name('products.search');
    //  Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
    //  Route::post('/products/store',[ProductController::class,'store'])->name('products.store');
    //  Route::get('/products/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
    //  Route::post('/products/update/{id}',[ProductController::class,'update'])->name('products.update');
    //  Route::get('/products/delete/{id}',[ProductController::class,'delete'])->name('products.delete'); 
    //  Route::get('/products/barcodes/{id}',[ProductController::class,'barcodes'])->name('products.barcodes');
    //  Route::get('/products/barcodes-generate/{id}/{size}',[ProductController::class,'barcodes_generate'])->name('products.barcodes_generate');


    //  //Attributes
    //  Route::get('/attributes/{slug}/index',[AttributeController::class,'index'])->name('attributes.index');
    //  Route::get('/attributes/{slug}/create',[AttributeController::class,'create'])->name('attributes.create');
    //  Route::post('/attributes/{slug}/store',[AttributeController::class,'store'])->name('attributes.store');
    //  Route::get('/attributes/{slug}/edit/{id}',[AttributeController::class,'edit'])->name('attributes.edit');
    //  Route::post('/attributes/{slug}/update/{id}',[AttributeController::class,'update'])->name('attributes.update');
    //  Route::get('/attributes/{slug}/delete/{id}',[AttributeController::class,'delete'])->name('attributes.delete');
    //  //  Route::get('/categories/search',[CategoryController::class,'search'])->name('categories.search');



    //   //Purchase Orders
    //   Route::get('/purchase-orders',[PurchaseOrderController::class,'index'])->name('purchase_orders.index');
    //   Route::get('/purchase-orders/search',[PurchaseOrderController::class,'search'])->name('purchase_orders.search');
      
      
    //   Route::get('/purchase-orders/type/{id}',[PurchaseOrderController::class,'type'])->name('purchase_orders.type');
    //   Route::get('/purchase-orders/delete/{id}',[PurchaseOrderController::class,'delete'])->name('purchase_orders.delete'); 
    //   Route::get('/purchase-orders/type/{type}/edit/{id}',[PurchaseOrderController::class,'edit'])->name('purchase_orders.edit');
    //   Route::get('/purchase-orders/type/{type}/view/{id}',[PurchaseOrderController::class,'view'])->name('purchase_orders.view');

    //   Route::post('/purchase-orders/fabric/update/{id}',[PurchaseOrderController::class,'fabric_update'])->name('purchase_orders.fabric_update');
    //   Route::post('/purchase-orders/button/update/{id}',[PurchaseOrderController::class,'button_update'])->name('purchase_orders.button_update');
    //   Route::post('/purchase-orders/stitching_thread/update/{id}',[PurchaseOrderController::class,'stitching_thread_update'])->name('purchase_orders.stitching_thread_update');
    //   Route::post('/purchase-orders/furing/update/{id}',[PurchaseOrderController::class,'furing_update'])->name('purchase_orders.furing_update');
    //   Route::post('/purchase-orders/tags/update/{id}',[PurchaseOrderController::class,'tags_update'])->name('purchase_orders.tags_update');
    //   Route::post('/purchase-orders/polybags/update/{id}',[PurchaseOrderController::class,'polybags_update'])->name('purchase_orders.polybags_update');
    //   Route::post('/purchase-orders/collar_bone/update/{id}',[PurchaseOrderController::class,'collar_bone_update'])->name('purchase_orders.collar_bone_update');
    //   Route::post('/purchase-orders/labels/update/{id}',[PurchaseOrderController::class,'labels_update'])->name('purchase_orders.labels_update');
    //   Route::post('/purchase-orders/dori_for_tags/update/{id}',[PurchaseOrderController::class,'dori_for_tags_update'])->name('purchase_orders.dori_for_tags_update');
    //   Route::post('/purchase-orders/caps/update/{id}',[PurchaseOrderController::class,'caps_update'])->name('purchase_orders.caps_update');
    //   Route::post('/purchase-orders/sandles/update/{id}',[PurchaseOrderController::class,'sandles_update'])->name('purchase_orders.sandles_update');
    //   Route::post('/purchase-orders/waist_coat/update/{id}',[PurchaseOrderController::class,'waist_coat_update'])->name('purchase_orders.waist_coat_update');
    //   Route::post('/purchase-orders/lining/update/{id}',[PurchaseOrderController::class,'lining_update'])->name('purchase_orders.lining_update');
      
    //   //Purchase Receipts
    //   Route::get('/purchase-receipts/search',[PurchaseReceiptController::class,'search'])->name('purchase_receipts.search');
    //   Route::get('/purchase-receipts/index',[PurchaseReceiptController::class,'index'])->name('purchase_receipts.index');
    //   Route::get('/purchase-receipts/create',[PurchaseReceiptController::class,'create'])->name('purchase_receipts.create');
    //   Route::post('/purchase-receipts/store',[PurchaseReceiptController::class,'store'])->name('purchase_receipts.store');
    //   Route::get('/purchase-receipts/edit/{id}',[PurchaseReceiptController::class,'edit'])->name('purchase_receipts.edit');
    //   Route::get('/purchase-receipts/view/{id}',[PurchaseReceiptController::class,'view'])->name('purchase_receipts.view');
    //   Route::get('/purchase-receipts/delete/{id}',[PurchaseReceiptController::class,'delete'])->name('purchase_receipts.delete'); 
      
    //   //orders
    //   Route::get('/orders/import',[OrderController::class,'import'])->name('orders.import');
    //   Route::get('/orders/search',[OrderController::class,'search'])->name('orders.search');
    //   Route::get('/orders/index',[OrderController::class,'index'])->name('orders.index');
    //   Route::get('/orders/create',[OrderController::class,'create'])->name('orders.create');
    //   Route::post('/orders/store',[OrderController::class,'store'])->name('orders.store');
    //   Route::get('/orders/edit/{id}',[OrderController::class,'edit'])->name('orders.edit');
    //   Route::post('/orders/update/{id}',[OrderController::class,'update'])->name('orders.update');
    //   Route::get('/orders/view/{id}',[OrderController::class,'view'])->name('orders.view');
    //   Route::get('/orders/delete/{id}',[OrderController::class,'delete'])->name('orders.delete');
      
      
      // lining
      // waiscoats
      // sandils
      // furing
});




















// Route::get('/email', function () {


//     $data = [
//         'email' => 1,
//         'name' => 1,
//         'verification_code' => 1,
//         'verify_button' => 'asdasdasd',
//     ];

//     return view('emails.emailVerification',compact('data'));
// });