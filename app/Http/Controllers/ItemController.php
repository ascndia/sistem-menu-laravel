<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Validator;
use App\Models\Item;
use Illuminate\Http\Request;
use App\DataTables\ItemDataTable;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()->of(Item::all())->addColumn('action', function($item){
                return 
                '<a class="btn btn-secondary" href="'.route('item.edit',$item->id) .'"><i class=" bi bi-pencil-square"></i></a>
                <a class="btn btn-danger" href="'.route('item.destroy',$item->id) .'"><i class="bi bi-trash"></i></a>';
            })->rawColumns(['action'])->toJson();
        }
        return view('admin.items');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.create-item');
    
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
        return view('admin.edit-item');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
    
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
            return redirect()->back()->withErrors($validator);
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

    /**
     * Toggle item 'showing' state in the database
     */
    public function toggleShowing(Item $item)
    {
        $item->toggleShowing();

        return response()->json(['message' => 'Showing attribute toggled successfully', 'id' => $item->id]);
    }

}
