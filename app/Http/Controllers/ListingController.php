<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{

    public function index(){
        
        return view('listings.index', [
            'listings'=> Listing::latest()->filter(request(['tag','search']))->paginate(6)
        ]);
    }
    //show all listings ist eine unterschiedliche Art für die dd() funktion
    /* public function index(Request $request){
        dd($request->tag);
        return view('listings.index',[
        
            'listings'=> Listing::all()
        ]);
    } */
    //Single Listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
        ]);
    }

    //show create form
    public function create(){
        return view('listings.create');
    }
    //Store Listing Data
    public function store(Request $request){
       
        $formFields = $request->validate([
            'title' => 'required',
            //unique() does not work
            'company'=> ['required',Rule::unique('listings','company')],
            'location'=> 'required',
            'website'=> 'required',
            'email'=> 'required',
            'tags'=>'required',
            'discription'=>'required'

        ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos',
            'public');
        }

        Listing::create($formFields);

        //Session::flash('message','Listing Created');
    

        return redirect('/')->with('message','Listing created successfully');
    }
    



}
