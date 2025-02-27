<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            ['location' => 'HARCO GLODOK'],
            ['location' => 'ASPEN PEAK RESIDENCE - TOWER C'],
            ['location' => 'ASPEN PEAK RESIDENCE - TOWER D'],
            ['location' => 'ASPEN RESIDENCE - TOWER A'],
        ]);
    }
}
