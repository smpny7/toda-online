<?php

namespace Database\Seeders;

use SplFileObject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject('database/csv/videos.csv');
        $file->setFlags(
            \SplFileObject::READ_CSV |
                \SplFileObject::READ_AHEAD |
                \SplFileObject::SKIP_EMPTY |
                \SplFileObject::DROP_NEW_LINE
        );
        $lists = [];
        foreach ($file as $i => $line) {
            $lists[] = [
                'class' => $line[0],
                'chapter' => $line[1],
                'section' => $line[2],
                'title' => $line[3],
            ];
        }

        DB::transaction(function () use ($lists) {
            $pack = [];
            $inserts = 0;
            foreach ($lists as $list) {
                $pack[] = $list;
                if (count($pack) >= 1000) {
                    $inserts += count($pack);
                    DB::table('videos')->insert($pack);
                    $pack = [];
                }
            }
            $inserts += count($pack);

            // Insert of extra rows
            DB::table('videos')->insert($pack);
        });
    }
}
