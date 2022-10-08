<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EssaySeeder extends Seeder
{
    public function run()
    {
        DB::table('essay_contests')->insert([
            'id' => 1,
            'nama' => "Final Logika ILPC 2021",
            'jadwal_mulai' => Carbon::now()->format('Y-m-d H:i:s'),
            'jadwal_selesai' => Carbon::now()->format('Y-m-d H:i:s'),
            'admin_id' => 2,
            'slug' => "final-logika-ilpc-2021-09876543",
        ]);
        DB::table('essay_questions')->insert([
            'id' => 1,
            'nomor' => 1,
            'isi' => '<p style="text-align: justify;">Apakah jawaban nomor 1</p>',
            'essay_contest_id' => 1,
        ]);
        DB::table('essay_questions')->insert([
            'id' => 2,
            'nomor' => 2,
            'isi' => '<p style="text-align: justify;">Apakah jawaban nomor 2</p>',
            'essay_contest_id' => 1,
        ]);
        DB::table('essay_questions')->insert([
            'id' => 3,
            'nomor' => 3,
            'isi' => '<p style="text-align: justify;">Apakah jawaban nomor 3</p>',
            'essay_contest_id' => 1,
        ]);
        DB::table('essay_questions')->insert([
            'id' => 4,
            'nomor' => 4,
            'isi' => '<p style="text-align: justify;">Apakah jawaban nomor 4</p>',
            'essay_contest_id' => 1,
        ]);
    }
}
