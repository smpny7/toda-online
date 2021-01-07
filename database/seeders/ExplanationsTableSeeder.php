<?php

namespace Database\Seeders;

use Carbon\Carbon;
use SplFileObject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class  ExplanationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject('database/csv/explanations.csv');
        $file->setFlags(
            \SplFileObject::READ_CSV |
                \SplFileObject::READ_AHEAD |
                \SplFileObject::SKIP_EMPTY |
                \SplFileObject::DROP_NEW_LINE
        );
        $lists = [];
        foreach ($file as $line) {
            $lists[] = [
                'class_key' => $line[0],
                'chapter_key' => $line[1],
                'data' => $line[2],
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ];
        }

        DB::transaction(function () use ($lists) {
            $pack = [];
            foreach ($lists as $list) {
                $pack[] = $list;
                if (count($pack) >= 1000) {
                    DB::table('explanations')->insert($pack);
                    $pack = [];
                }
            }

            // Insert of extra rows
            DB::table('explanations')->insert($pack);
        });
    }
}
