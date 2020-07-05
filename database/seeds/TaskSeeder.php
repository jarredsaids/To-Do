<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('priorities')->insert([
            [
                'name' => 'urgent',
            ],
            [
                'name' => 'important',
            ],
            [
                'name' => 'ignore',
            ],
            [
                'name' => 'optional',
            ],
        ]);
    }
}
