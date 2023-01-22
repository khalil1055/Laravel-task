<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Table::insert([
            ['number' => "#table1"],
            ['number' => "#table2"],
            ['number' => "#table3"],
        ]);
    }
}
