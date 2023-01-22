<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create(['name'=> 'item one' , 'price' => 10.0]);
        Item::create(['name'=> 'item two' , 'price' => 14.0]);
        Item::create(['name'=> 'item three' , 'price' => 12.0]);
    }
}
