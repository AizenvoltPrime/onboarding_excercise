<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Call the TaskSeeder
        $this->call(
            UsersTableSeeder::class
        );

        $this->call([
            AdminsTableSeeder::class,
        ]);

        $this->call(TaskSeeder::class);
    }
}
