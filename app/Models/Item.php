<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use HasFactory;

	protected $table = 'items';

	protected $fillable = [
		'name',
		'price',
		'image',
		'description',
		'showing',
		'discount_nominal',
		'discount_percentage',
		'group_id',
	];
	
	public function group(){
		return $this->belongsTo(Group::class,'group_id');
	}


	public function toggleShowing()
    {
        $this->showing = !$this->showing;
        $this->save();
    }
}
