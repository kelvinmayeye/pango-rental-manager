<?php

namespace App\Http\Controllers\Properties;

use Auth;
use Illuminate\Http\Request;
use App\Models\Categories\Category;
use App\Models\Properties\Property;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class PropertyController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $properties = Property::where( 'user_id', auth()->user()->id )->latest()->paginate( 10 );
        return view( 'backend.properties.index', compact( 'properties' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        $categories = Category::all();
        return view( 'backend.properties.create', compact( 'categories' ) );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $property = new Property();
        $property->name = $request->name;
        $property->description = $request->description;
        $property->category_id = $request->category_id;
        $property->user_id = auth()->user()->id;
        
        try {
            $property->save();
            Session::flash( 'success', 'Property successfully created' );
            return redirect()->route( 'properties.index' );
        } catch ( QueryException $exception ) {
            Session::flash( 'error', 'Failed to create property' );
            return back();
        }
    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        $property = Property::find($id);
        if (!$property) {
            ession::flash('error', 'Property not found');
            return back();
        }
        return view('backend.properties.show',compact('property'));
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( $id ) {
        $property = Property::find($id);
        if (!$property) {
            ession::flash('error', 'Property not found');
            return back();
        }
        $categories = Category::where('id', '!=', $property->category_id)->get();
        return view('backend.properties.edit',compact('property','categories'));
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        $property = Property::find($id);
        if (!$property) {
            Session::flash('error', 'Property not found');
            return back();
        }
        $property->name = $request->name;
        $property->category_id = $request->category_id;
        $property->description = $request->description;
        $property->save();
        Session::flash('success', 'Property successfully updated');
        return redirect()->route('properties.index');
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        $property = Property::find($id);
        if (!$property) {
            Session::flash('error', 'Property not found');
            return back();
        }
        
        if ($property->tenantProperties->isEmpty()) {
            try {
                $property->delete();
                Session::flash('success', 'Property deleted successfully');
                return redirect()->route('properties.index');
            } catch (QueryException $exception) {
                Session::flash('error', 'Failed to be deleted');
                return back();
            }
        }else{
            Session::flash('error', 'Failed to be deleted property is rented to tenant');
            return back();
        }
        
    }
}
