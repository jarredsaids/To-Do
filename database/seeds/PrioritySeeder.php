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
            $priorities = array_rand(range(1, 4), rand(1, 2));
            $task->priorities()->sync($priorities);
        });
    }
}
