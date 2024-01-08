<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Item;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $groups = ['makanan', 'minuman', 'jajanan'];

        $num_of_item_per_group = 30;

        foreach($groups as $group){
            $g = Group::create([
                'name' => $group
            ]);

            for($i = 0; $i < $num_of_item_per_group; $i++){

                Item::create([
                    'name' => $faker->word(),
                    'price' => $faker->numberBetween($min = 10000, $max = 230000),
                    'image' => $faker->numberBetween(10000,99999).".jpg",
                    'description' => $faker->sentence(),
                    'group_id' => $g->id
                ]);


            }


        }
    }
}
