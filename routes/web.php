<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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
//all listings
/* Route::get('/listings', function () {
    return view('listings',[
        
        'listings'=> Listing::all()
    ]);
}); */

/* Route::get('/posts/{id}', function ($id) {
    dd($id);
    return response('Post ' .$id);
    dd($id);
})->where('id','[0-9]+'); */

/* Route::get('/',[ListingController::class,'filter']);  */

Route::get('/',[ListingController::class,'index']);


//store ListingData
Route::post('/listings',[ListingController::class,'store']);

//show Edit Form
Route::get('/listings/{listing}/edit',[ListingController::class,'edit']);

//Edit Submit to Update
Route::put('listings/{listing}',[ListingController::class,'update']);

//Delete Listings
Route::delete('listings/{listing}',[ListingController::class,'destroy']);


Route::get('/listings',[ListingController::class,'index']);


//get to the create side
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');


//get a special list
Route::get('/listings/{listing}',[ListingController::class,'show']);

//show register/create Form
Route::get('/register',[UserController::class,'create'])->middleware('guest');

//show register/create Form
//

//create new Users
Route::post('/users',[UserController::class,'store']);

//log user out 
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

//show login form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

//login USer
Route::post('/users/authenticate',[UserController::class,'authenticate']);

//Manage Listings
Route::get('/listings/manage',[ListingController::class,'manage']);//->middleware('auth')


    
    

/* Route::get('/',function(){
    return view('listing',
    [
        'heading' => 'Latest Listings',
        'listing' => Listing::all()
    ]);
}); */