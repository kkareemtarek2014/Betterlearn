<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\cartcontoller;
use  Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use  App\Http\Controllers\OrderController;
use  App\Http\Controllers\CourseController;

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


Route::get('/' , [CourseController::class , 'featured'])->name('home');
Route::get('/course' , [CourseController::class , 'index'])->name('courses');
Route::get('/loadData' , [CourseController::class , 'store']);
Route::view('/cart' ,'cart')-> name('cart');
Route::get('/details/{course_details}' , [CourseController::class , 'getID']) ->name('details');
Route::view('/checkout' ,'checkout')-> name('checkout')->middleware('auth');
Route::get('/add_to_cart/{course_ID}' , [CourseController::class , 'addToCart'])->name('cart.add');
Route::get('/delete' , [cartcontoller::class , 'delete'])->name('cart.delete');
Route::view('/contactus' ,'contactus')-> name('contactus');
Route::view('/aboutus' ,'aboutus')-> name('aboutus');
Route::get('/cart/destroy/{itemid}' ,[cartcontoller::class , 'destroy'])-> name('cart.destroy');
Route::get('/ContiueCheckout',[OrderController::class,'addData'])->name('store');
Route::get('/destroy',[cartcontoller::class,'delete']);
Route::view('/Thankyou' ,'Thankyou')-> name('Thankyou');
Route::get('/data' , [CourseController::class , 'Databases']);
Route::get('/migrate',function(){
    Artisan::call('migrate');

});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all();
    return view('dashboard',compact('users'));
})->name('dashboard');


Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    $users = User::all();
    return view('dashboard',compact('users'));
})->name('dashboard');
Route::get('/Orders/all' , [OrderController::class , 'allorder'])->name('All.order');
Route::get('/softdelete/order/{id}' , [OrderController::class , 'SoftDelete']);
Route::get('/Order/restore/{id}' , [OrderController::class , 'Restore']);
Route::get('/Order/pdelete/{id}' , [OrderController::class , 'Pdelete']);
Route::get('/brand/all' , [CourseController::class , 'AllBrand'])->name('all.brand');
Route::get('/course/pdelete/{id}' , [CourseController::class , 'Pdelete']);
Route::post('/course/add' , [CourseController::class , 'AddNewCourse'])->name('store.course');
Route::get('/form' , [formcontroller::class , 'newdata'])->name('python');
use App\Http\controllers\Tripledes;


/* ----------Admin Route -------------*/
/* ------------- Admin Route -------------- */
Route::group(['prefix'=> 'admin','middleware'=>['admin:admin']],function(){

Route::get('/login',[AdminController::class, 'loginForm']);
Route::post('/login',[AdminController::class, 'store'])->name('admin.login');

});


/* ----------End Admin Route -------------*/
