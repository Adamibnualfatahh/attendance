<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

/**
 * @author Adam Ibnu <adamibnu157@gmail.com>
 */
use Faker\Generator as Faker;

$factory->define(App\Models\AnnualLeave::class, function (Faker $faker) {
    $user = factory(\App\Models\User::class)->create();

    $startDate = $faker->dateTimeBetween('-5 days', '+10 days');
    $endDate = $faker->dateTimeBetween($startDate, $startDate->format('Y-m-d').' +5 days');

    $annualLeave = [
        'user_id' => \App\Models\User::inRandomOrder()->first()->id,
        'reason' => $faker->text,
        'status' => $faker->randomElement(['pending', 'approved', 'rejected']),
    ];

    $annualLeaveModel = \App\Models\AnnualLeave::create($annualLeave);

    $currentDate = clone $startDate;

    while ($currentDate <= $endDate) {
        $annualLeaveModel->leaveDates()->create([
            'leave_date' => $currentDate->format('Y-m-d'),
        ]);

        $currentDate->modify('+1 day');
    }

    return $annualLeave;
});
