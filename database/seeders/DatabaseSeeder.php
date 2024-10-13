<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'firstname' => 'editor',
            'lastname' => 'lastname',
            'email' => 'editor@app.com',
            'password' => Hash::make('password'),
            'type' => 'editor',
            'status' => 'active',
        ]);

        User::factory()->create([
            'firstname' => 'writer',
            'lastname' => 'lastname',
            'email' => 'writer@app.com',
            'password' => Hash::make('password'),
            'type' => 'writer',
            'status' => 'active',
        ]);

        $users = User::factory()->count(20)->create();
        $companies = Company::factory()->count(10)->create();

        $articles = Article::factory()
            ->count(30)
            ->state(new Sequence(fn () => [
                'writer' => $users->random(),
                'company' => $companies->random(),
            ]))
            ->create();

    }
}
