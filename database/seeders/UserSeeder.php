<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(5)->create();

        DB::table('users')->insert([
            'name' => 'nerdcia',
            'email' => 'dev@nerdcia.com',
            'password'=> bcrypt('nerdcia2032#*'),
        ]);

        DB::table('users')->insert([
            'name' => 'demo',
            'email' => 'demo@demo.com',
            'password'=> bcrypt('demo'),
        ]);
    }
}
