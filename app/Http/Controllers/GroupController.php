<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.groups');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:groups',
            'showing' => 'nullable|boolean'
	    ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Group::create($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }

    /**
     * Toggle item 'showing' state in the database
     */
    public function toggleShowing(Group $group)
    {
        $group->toggleShowing();

        return response()->json(['message' => 'Showing attribute toggled successfully', 'id' => $group->id]);
    }
}
