<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\News;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@stevens.edu',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
            'password' => Hash::make('hello123')
        ]);

        User::create([
            'name' => 'Abhinav Garg',
            'email' => 'agarg10@stevens.edu',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('hello123')
        ]);

        User::factory(2)->create();
        News::factory(5)->create(['user_id' => '1']);
        News::factory(5)->create(['user_id' => '2']);
        Event::factory(5)->create(['user_id' => '1']);
        Event::factory(10)->create(['user_id' => '2']);
    }
}
