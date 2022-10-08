<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class McSeeder extends Seeder
{
    public function run()
    {
        DB::table('mc_contests')->insert([
            'id' => 1,
            'nama' => "Penyisihan Logika",
            'jadwal_mulai' => Carbon::now()->format('Y-m-d H:i:s'),
            'jadwal_selesai' => Carbon::now()->format('Y-m-d H:i:s'),
            'admin_id' => 2,
            'slug' => "penyisihan-logika-09876543",
        ]);

        DB::table('mc_questions')->insert(['id' => 1, 'nomor'=>'1', 'isi' => '<p style="text-align: justify;">Apakah jawaban nomor 1</p>', 'jawaban_benar' => 'a', 'mc_contest_id' => 1,]);
        DB::table('mc_choices')->insert(['id' => 1, 'abjad' => 'a', 'isi' => 'Ini jawabannya ya', 'mc_question_id' => 1,]);
        DB::table('mc_choices')->insert(['id' => 2, 'abjad' => 'b', 'isi' => 'Apakah B', 'mc_question_id' => 1,]);
        DB::table('mc_choices')->insert(['id' => 3, 'abjad' => 'c', 'isi' => 'Apakah C', 'mc_question_id' => 1,]);
        DB::table('mc_choices')->insert(['id' => 4, 'abjad' => 'd', 'isi' => 'Apakah D', 'mc_question_id' => 1,]);
        DB::table('mc_choices')->insert(['id' => 5, 'abjad' => 'e', 'isi' => 'Apakah E', 'mc_question_id' => 1,]);

        DB::table('mc_questions')->insert(['id' => 2, 'nomor'=>'2', 'isi' => '<p style="text-align: justify;">Apakah jawaban nomor 2</p>', 'jawaban_benar' => 'e', 'mc_contest_id' => 1,]);
        DB::table('mc_choices')->insert(['id' => 6, 'abjad' => 'a', 'isi' => 'Apakah ini', 'mc_question_id' => 2,]);
        DB::table('mc_choices')->insert(['id' => 7, 'abjad' => 'b', 'isi' => 'Apakah itu', 'mc_question_id' => 2,]);
        DB::table('mc_choices')->insert(['id' => 8, 'abjad' => 'c', 'isi' => 'Apakah sana', 'mc_question_id' => 2,]);
        DB::table('mc_choices')->insert(['id' => 9, 'abjad' => 'd', 'isi' => 'Apakah sono', 'mc_question_id' => 2,]);
        DB::table('mc_choices')->insert(['id' => 10, 'abjad' => 'e', 'isi' => 'Ini jawabannya dong', 'mc_question_id' => 2,]);
    }
}
