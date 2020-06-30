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
        DB::table('priorities')->insert([
           'p_type' => 'urgent',
        ]);
        DB::table('priorities')->insert([
            'p_type' => 'important',
        ]);
        DB::table('priorities')->insert([
            'p_type' => 'ignore',
        ]);
        DB::table('priorities')->insert([
            'p_type' => 'optional',
        ]);
    }
}
