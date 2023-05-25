<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Admin::create([
            'name' => 'Admin Inti',
            'email' => 'inti@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'inti',
        ]);
        Admin::create([
            'name' => 'Admin Competition',
            'email' => 'competition@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'competition',
        ]);
        Admin::create([
            'name' => 'Admin Competitive Programming',
            'email' => 'competitive_programming@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'competitive_programming',
        ]);
        Admin::create([
            'name' => 'Admin UI/UX Design',
            'email' => 'uiux_design@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'uiux_design',
        ]);
        Admin::create([
            'name' => 'Admin Web Development',
            'email' => 'web_development@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'web_development',
        ]);
        Admin::create([
            'name' => 'Admin Mobile Legends',
            'email' => 'mobile_legends@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mobile_legends',
        ]);
        Admin::create([
            'name' => 'Admin Seminar',
            'email' => 'seminar@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'seminar',
        ]);
    }
}