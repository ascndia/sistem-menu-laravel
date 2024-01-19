<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Validator;
use App\Models\Item;
use App\Models\Group;
use Illuminate\Http\Request;
use App\DataTables\ItemDataTable;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $groups = Group::all();
        if($request->ajax()){
            return datatables()->of(Item::all())->addColumn('action', function($item){
                return 
                '<i data-id="' . $item->id . '" 
                    data-name="'.$item->name.'" 
                    data-description="'.$item->description.'"
                    data-price="'.$item->price.'" 
                    data-showing="'.$item->showing.'" 
                    data-discount-nominal="'.$item->discount_nominal.'"
                    data-discount-percentage="'.$item->discount_percentage.'" 
                    data-image="'.$item->image.'"
                    data-group-name="'.($item->group)->name.'" 
                    data-group-id="'.$item->group_id.'" 
                    class="action-edit bg-secondary text-white me-1 p-1 bi bi-pencil-square"></i>
                <i  data-id="' . $item->id . '" class="action-delete bg-danger text-white p-1 bi bi-trash"></i>';
            })->rawColumns(['action'])->toJson();
        }
        return view('admin.items', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $groups = Group::all();
        return view('admin.create-item',compact('groups'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
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
                return redirect()->back()->withInput()->withErrors($errors);
	    };
 	
	    //Item::create($request->all());
	      
	    $item = Item::create($request->except('image'));
        

	    if ($request->hasFile('image')){
		    $image = $request->file('image');
		    $randomid = date('YmdHis') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
		    $path = $image->storeAs('public/images', $randomid);
		    $item->image = $randomid;
	    }

	    $item->save();

        return redirect()->back()->with([
            'success' => 'succesfully added',
            'data' => $item
        ]);
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
            'name' => 'nullable|string|unique:items,name,'.$item->id,
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'showing' => 'nullable|boolean',
            'group_id' => 'nullable|integer',
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
		    $item->image = $randomid;

	    }

        $item->update($request->only(['name', 'price', 'description', 'image', 'showing', 'group_id', 'discount_nominal', 'discount_percentage']));

        return redirect()->action([ItemController::class, 'index'])->with([
            'success' => 'Item succesfully updated',
            'data' => $item
        ]);

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
