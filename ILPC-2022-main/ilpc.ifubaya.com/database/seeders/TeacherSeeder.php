<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run($path, $model)
    {
        include("csv-reader.php");
    }
}
