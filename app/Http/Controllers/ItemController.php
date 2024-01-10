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
        return view('admin.items');
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
		'description' => 'nullable|string',
		'showing' => 'nullable|boolean',
		'group_id' => 'required|integer',
		'discount_nominal' => 'nullable|integer|min:0',
		'discount_percentage' => 'nullable|numeric|between:0,100',
		'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
	    ]);

	    if($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
	    };
 	
	    //Item::create($request->all());
	    
	    $item = new Item;

	    if ($request->hasFile('image')){
		    $image = $request->file('image');
		    $randomid = date('YmdHis') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
		    $path = $image->storeAs('public/images', $randomid);
		    $item->image = $path;
	    }

	    $item->name = $request->name;
	    $item->description = $request->description;
	    $item->showing = $request->showing;
	    $item->group_id = $request->group_id;
	    $item->discount_nominal = $request->discount_nominal;
	    $item->discount_percentage = $request->discount_percentage;

	    $item->save();
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:items',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'showing' => 'nullable|boolean',
            'group_id' => 'required|integer',
            'discount_nominal' => 'nullable|integer|min:0',
            'discount_percentage' => 'nullable|numeric|between:0,100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            // Redirect back with validation errors and old input
        }
        
        if ($request->hasFile('image')){

            // delete old image if exist
            if ($item->image && Storage::exists($item->image)) {
                Storage::delete($item->image);
            }

		    $image = $request->file('image');
		    $randomid = date('YmdHis') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
		    $path = $image->storeAs('public/images', $randomid);
		    $item->image = $path;

	    }

        return redirect()->route('items.index', $item->id)->with('success', 'Item updated successfully');

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
