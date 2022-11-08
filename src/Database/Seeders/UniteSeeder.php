<?php

namespace Theutz\Unite\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('laravel_unite_units')->insert([
            'symbol' => 'g',
        ]);
    }
}
