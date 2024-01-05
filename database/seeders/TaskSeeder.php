<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ensure there are users to assign tasks to
        if (User::count() == 0) {
            // If no users exist, create some
            User::factory(10)->create();
        }

        foreach (range(1, 50) as $index) {
            $status = $faker->randomElement(['pending', 'complete']);

            $completed = $status === 'complete' ? 1 : 0;

            $user = User::inRandomOrder()->first(); // Fetch the first user

            // If there are no users, you might want to create one
            if (!$user) {
                $user = User::factory()->create(); // Create a new user using the UserFactory
            }

            DB::table('tasks')->insert([
                'name' => $faker->sentence(3), // Generate a random task name
                'user_id' => $user->id,
                'priority' => $faker->randomElement(['low', 'normal', 'high']), // Random priority
                'status' => $status, // Random status
                'completed' => $completed, // Random completed boolean
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
