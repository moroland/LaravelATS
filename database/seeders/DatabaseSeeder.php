<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use App\Models\Position;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'test@example.com',
            'is_admin' => true,
            'password' => bcrypt('alma'),
        ]);

        User::factory()->create([
            'name' => 'Test Applicant',
            'email' => 'testapplicant@example.com',
            'is_admin' => false,
            'password' => bcrypt('alma'),
        ]);

        Position::factory(10)->create();
        JobApplication::factory(50)->create();
    }
}
