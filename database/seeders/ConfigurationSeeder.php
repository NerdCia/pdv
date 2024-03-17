<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configurations')->insert([
            'key' => 'company_name',
            'value'=> 'Nerd&Cia',
        ]);

        DB::table('configurations')->insert([
            'key' => 'logo',
            'value'=> 'logos/logo.png',
        ]);
    }
}
