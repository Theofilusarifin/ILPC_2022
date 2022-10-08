<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PrgSeeder extends Seeder
{
    public function run()
    {
        DB::table('prg_contests')->insert([
            'id' => 1,
            'nama' => "Final Programming ILPC 2021",
            'jadwal_mulai' => Carbon::now()->format('Y-m-d H:i:s'),
            'jadwal_selesai' => Carbon::now()->format('Y-m-d H:i:s'),
            'admin_id' => 2,
            'scoreboard_freeze' => 20,
            'scoreboard_status' => 'active',
            'scoreboard_slug' => 'final-programming-ilpc-2021-09876543',
            'slug' => "final-programming-ilpc-2021-09876543",
        ]);
        DB::table('prg_questions')->insert(['id' => 1, 'nomor' => '1', 'judul' => 'STRING ENCODING (CPP)', 'isi' => '<p style="text-align: justify;">Apakah jawaban nomor 1</p>', 'input' => 'storage/prg/soal/cpp.in', 'output' => 'storage/prg/soal/cpp.out', 'time_limit' => '1', 'prg_contest_id' => 1,]);
        DB::table('prg_questions')->insert(['id' => 2, 'nomor' => '2', 'judul' => 'RARE NUMBER (Java)', 'isi' => '<p style="text-align: justify;">Apakah jawaban nomor 2</p>', 'input' => 'storage/prg/soal/java.in', 'output' => 'storage/prg/soal/java.out', 'time_limit' => '1', 'prg_contest_id' => 1,]);
    }
}
