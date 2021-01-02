<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        foreach ($file as $line) {
            $lists[] = [
                'class' => $line[0],
                'class_key' => $line[1],
                'chapter' => $line[2],
                'chapter_key' => $line[3],
                'section' => $line[4],
                'section_key' => $line[5],
                'video_id' => $line[6],
                'title' => $line[7],
                'path' => 'video/' . $line[1] . '/' . $line[3] . '/' . $line[5] . '/'  . $line[6] . '.mp4',
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ];
        }

        DB::transaction(function () use ($lists) {
            $pack = [];
            foreach ($lists as $list) {
                $pack[] = $list;
                if (count($pack) >= 1000) {
                    DB::table('videos')->insert($pack);
                    $pack = [];
                }
            }

            // Insert of extra rows
            DB::table('videos')->insert($pack);
        });
    }
}
