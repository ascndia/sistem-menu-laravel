<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	use HasFactory;

	protected $table = 'groups';

	protected $fillable = [
		'name',
		'showing'
	];

	public function items(){
		return $this->hasMany(Item::class);
	};

	public function count(){
		return $this->products()->count();
	};

}
