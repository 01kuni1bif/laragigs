<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
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


Route::get('/listings',[ListingController::class,'index']);


//get to the create side
Route::get('/listings/create',[ListingController::class,'create']);


//get a special list
Route::get('/listings/{listing}',[ListingController::class,'show']);

    
    

/* Route::get('/',function(){
    return view('listing',
    [
        'heading' => 'Latest Listings',
        'listing' => Listing::all()
    ]);
}); */