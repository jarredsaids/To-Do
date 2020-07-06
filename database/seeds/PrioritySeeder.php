<?php

use App\Task;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::all()->each(function ($task) {
            $collection = collect(range(1,4));
            $task->priorities()->sync($collection->random(2));
        });
    }
}
