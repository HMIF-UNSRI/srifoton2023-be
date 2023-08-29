<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use App\Models\CompetitiveProgramming;
use App\Models\MobileLegend;
use App\Models\Seminar;
use App\Models\UiuxDesign;
use App\Models\WebDevelopment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();
        // CompetitiveProgramming::factory(50)->create();
        // Seminar::factory(50)->create();
        // WebDevelopment::factory(50)->create();
        // UiuxDesign::factory(50)->create();

        Admin::create([
            'name' => 'Admin Inti',
            'username' => 'inti',
            'password' => Hash::make('salambooyah'),
            'role' => 'inti',
        ]);
        Admin::create([
            'name' => 'Admin Competition',
            'username' => 'competition',
            'password' => Hash::make('mainnyahebat'),
            'role' => 'competition',
        ]);
        Admin::create([
            'name' => 'Admin Competitive Programming',
            'username' => 'competitive_programming',
            'password' => Hash::make('akubutuhpeluru'),
            'role' => 'competitive_programming',
        ]);
        Admin::create([
            'name' => 'Admin UI/UX Design',
            'username' => 'uiux_design',
            'password' => Hash::make('seranglord'),
            'role' => 'uiux_design',
        ]);
        Admin::create([
            'name' => 'Admin Web Development',
            'username' => 'web_development',
            'password' => Hash::make('majumajumaju'),
            'role' => 'web_development',
        ]);
        Admin::create([
            'name' => 'Admin Seminar',
            'username' => 'seminar',
            'password' => Hash::make('kerjabagus'),
            'role' => 'seminar',
        ]);
        Admin::create([
            'name' => 'Admin Finance',
            'username' => 'finance',
            'password' => Hash::make('akupunyaini'),
            'role' => 'finance',
        ]);
    }
}
