<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['name' => 'water 1' , 'phone' => 02154532 , 'type' => 'waiter' ],
            ['name' => 'water 2' , 'phone' => 02451532 , 'type' => 'waiter' ],
        ]);
    }
}
