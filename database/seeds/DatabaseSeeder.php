<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the Priorities database with the preselected values
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TaskSeeder::class,
            PrioritySeeder::class
        ]);
    }
}
