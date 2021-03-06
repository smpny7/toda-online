<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'test',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$.vBmYboSAsyah45afwG1qe0gbt59aEbmdVkUnmyWQrJYrSaGlHDOC',
                'remember_token' => Str::random(10),
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
                'grade' => 0,
            ]
        ]);
    }
}
