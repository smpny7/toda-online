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
        foreach ([
                     'math1' => '数学 I',
                     'math2' => '数学 Ⅱ',
                     'mathA' => '数学 A',
                     'mathB' => '数学 B',
                 ] as $class_key => $class) {
            $file = new SplFileObject('database/csv/' . $class_key . '.csv');
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
                    'chapter_id' => $line[2],
                    'chapter' => $line[3],
                    'chapter_key' => $line[4],
                    'section_id' => $line[5],
                    'section' => $line[6],
                    'section_key' => $line[7],
                    'video_id' => $line[8],
                    'title' => $line[9],
                    'file_path' => 'video/' . $line[1] . '/' . $line[4] . '/' . $line[7] . '/' . $line[8] . '.mp4',
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
}
