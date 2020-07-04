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
            'hex_color' => '#ff0000',
        ]);
        DB::table('priorities')->insert([
             'p_type' => 'important',
             'hex_color' => '#ffff00',
        ]);
        DB::table('priorities')->insert([
            'p_type' => 'ignore',
            'hex_color' => '#808080',
        ]);
        DB::table('priorities')->insert([
            'p_type' => 'optional',
            'hex_color' => '#0080ff',
        ]);
    }
}
