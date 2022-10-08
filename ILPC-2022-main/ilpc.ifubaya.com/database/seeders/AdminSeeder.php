<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run($path, $model)
    {
        include("csv-reader.php");
    }
}
