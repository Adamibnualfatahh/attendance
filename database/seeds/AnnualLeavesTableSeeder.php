<?php

declare(strict_types=1);

use App\Models\AnnualLeave;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

/**
 * @author Adam Ibnu <adamibnu157@gmail.com>
 */
class AnnualLeavesTableSeeder extends Seeder
{
    public function run()
    {
        factory(AnnualLeave::class, 10)->create();
    }
}
