<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Group;

class AdminController extends Controller
{
    //
	public function dashboard(){
		$item_count = Item::all()->count();
		$group_count = Group::all()->count();
		$data['item'] = $item_count;
		$data['group'] = $group_count;
		return view('admin.dashboard', $data);
    }
}
