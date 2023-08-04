<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'john doe',
            'email'=>'doe@gmail.com'
        ]);


        \App\Models\jobs::factory(47)->create([
            'user_id' => $user->id
        ]);

    }
}
