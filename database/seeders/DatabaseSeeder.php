<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // \App\Models\User::factory(50)->create();
        \App\Models\Product::factory(50)->create();
        \App\Models\Review::factory(300)->create();
    }
}
