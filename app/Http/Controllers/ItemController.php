<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Validator;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
	    //
	    $validator = Validator::make($request->all(),[
		'name' => 'required|string|unique:items',
		'price' => 'required|numeric|min:0',
		'description' => 'string',
		'showing' => 'boolean',
		'group_id' => 'required|integer',
		'discount_nominal' => 'integer|min:0',
		'discount_percentage' => 'numeric|between:0,100',
		'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'
	    ]);

	    if($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
	    };

	    Item::create($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
	    //
	    $item->delete();
    }
}
