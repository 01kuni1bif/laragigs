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
            $formFields['logo'] = $request->file('logo')->store
            ('logos','public');
        }
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        //Session::flash('message','Listing Created');
    

        return redirect('/')->with('message','Listing created successfully');
    }

    //Show Edit Form

    public function edit(Listing $listing){
        
        return view('listings.edit',['listing'=>$listing]);
    }
    //Update Listing Data
    public function update(Request $request,Listing $listing){
        //make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
       
        $formFields = $request->validate([
            'title' => 'required',
            //unique() does not work
            'company'=> 'required',
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

        $listing->update($formFields);

        //Session::flash('message','Listing Created');
    

        return back()->with('message','Listing updated successfully');
    }
    //delete Listings
    public function destroy(Listing $listing ){
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message','Listing Deleted Successfully !');
    }
    //manage

    public function manage(){
        return view('listings.manage');
    }



}
