<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 11; $i++) {
            DB::table('attendances')->insert([
                [
                    'user_id' => $i,
                    'math1' => rand(0, 1),
                    'math2' => rand(0, 1),
                    'math3' => rand(0, 1),
                    'mathA' => rand(0, 1),
                    'mathB' => rand(0, 1),
                    'created_at' => new Carbon(),
                    'updated_at' => new Carbon(),
                ]
            ]);
        }
    }
}
