<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            $status = $faker->randomElement(['pending', 'complete']);

            $completed = $status === 'complete' ? 1 : 0;

            DB::table('tasks')->insert([
                'name' => $faker->sentence(3), // Generate a random task name
                'priority' => $faker->randomElement(['low', 'normal', 'high']), // Random priority
                'status' => $status, // Random status
                'completed' => $completed, // Random completed boolean
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
