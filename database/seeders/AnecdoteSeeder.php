<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnecdoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 78; $i++) {
            DB::table('anecdotes')->insert([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'relation' => $faker->randomElement(['Ami', 'Collègue', 'Voisin', 'Cousin', 'Oncle']),
                'ville' => $faker->city,
                'pays' => $faker->country,
                'anecdote' => $faker->paragraph,
                'created_at' => Carbon::now()->subDays(rand(0, 365))->format('Y-m-d H:i:s'), // Random timestamp within the last year
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
