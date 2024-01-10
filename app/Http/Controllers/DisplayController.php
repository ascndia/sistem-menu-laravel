<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Item;

class DisplayController extends Controller
{
    //  display company profile page
    public function index(){
        return view('display.index');
    }

    // display list of groups page
    public function group(){
        $groups = Group::all()->where('showing', true);
        return view('display.group',compact('groups'));
    }

    // display items based on group id page
    public function items($groupid){
        $group = Group::find($groupid);
        if(!$group) { 
            return view('not_found.group');
        }
        $items = $group->items;

        $data['group'] = $group;
        $data['items'] = $items;

        return view('display.item', $data);
    }

    // display a single item page
    public function show($itemid){
        $item = Item::find($itemid);
        if(!$item){
            return view('not_found.item');
        }
        $group = $item->group;

        $data['item'] = $item;
        $data['group'] = $group;

        return view('display.show',$data);
    }
}

