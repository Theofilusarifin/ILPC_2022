<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    public function run($path, $model)
    {
        include("csv-reader.php");
    }
}
