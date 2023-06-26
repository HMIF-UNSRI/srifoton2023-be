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
        \App\Models\User::factory(5)->create();
        \App\Models\MobileLegend::factory(50)->create();

        Admin::create([
            'name' => 'Admin Inti',
            'username' => 'inti',
            'password' => Hash::make('12345678'),
            'role' => 'inti',
        ]);
        Admin::create([
            'name' => 'Admin Competition',
            'username' => 'competition',
            'password' => Hash::make('12345678'),
            'role' => 'competition',
        ]);
        Admin::create([
            'name' => 'Admin Competitive Programming',
            'username' => 'competitive_programming',
            'password' => Hash::make('12345678'),
            'role' => 'competitive_programming',
        ]);
        Admin::create([
            'name' => 'Admin UI/UX Design',
            'username' => 'uiux_design',
            'password' => Hash::make('12345678'),
            'role' => 'uiux_design',
        ]);
        Admin::create([
            'name' => 'Admin Web Development',
            'username' => 'web_development',
            'password' => Hash::make('12345678'),
            'role' => 'web_development',
        ]);
        Admin::create([
            'name' => 'Admin Mobile Legends',
            'username' => 'mobile_legends',
            'password' => Hash::make('12345678'),
            'role' => 'mobile_legends',
        ]);
        Admin::create([
            'name' => 'Admin Seminar',
            'username' => 'seminar',
            'password' => Hash::make('12345678'),
            'role' => 'seminar',
        ]);
    }
}
