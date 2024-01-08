<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
	    // item permissions
	    Permission::create(['name' => 'view item']);
	    Permission::create(['name' => 'add item']);
	    Permission::create(['name' => 'edit item']);
	    Permission::create(['name' => 'delete item']);
	    Permission::create(['name' => 'show item']);
	    Permission::create(['name' => 'unshow item']);

	    // group permissions
	    Permission::create(['name' => 'view item']);
	    
    }
}
