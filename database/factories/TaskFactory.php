<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\User;
use App\TaskStatus;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->realText(250, 2),
        'status_id' => function () {
            return factory(TaskStatus::class)->create()->id;
        },
        'creator_id' => function () {
            return factory(User::class)->create()->id;
        },
        'assignedTo_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
