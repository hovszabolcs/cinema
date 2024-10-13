<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Screening;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        Schema::disableForeignKeyConstraints();

        DB::table('screenings')->truncate();

        DB::table('movies')->truncate();

        Movie::factory(10)->create()->each(function ($movie) {
            Screening::factory(rand(3, 5))->create(['movie_id' => $movie->id]);
        });

        Schema::enableForeignKeyConstraints();
    }
}
