<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\CourseController;
use  App\Http\Controllers\cartcontoller;
use  App\Http\Controllers\OrderController;
use  Illuminate\Support\Facades\Artisan;

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
Route::view('/checkout' ,'checkout')-> name('checkout');
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
