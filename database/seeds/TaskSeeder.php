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
        $statuses = ["View", "In Progress", "Done"];
        for ($i = 0; $i < 40; $i++) {
            $task = new \App\Task;
            $task->user_id = rand(1, 40);
            $task->title = Str::random(50);
            $task->description = Str::random(100);
            $task->status = $statuses[rand(0, 2)];
            $task->save();
        }
    }
}
