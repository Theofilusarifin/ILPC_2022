<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Competition;
use App\Models\McChoices;
use App\Models\McContests;
use App\Models\McQuestions;
use App\Models\Participant;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Robot;
use App\Models\School;
use App\Models\Teacher;
use App\Models\Team;
use App\Models\Territory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Theo's personal CSV Seeder
        // Change csv path, and Model create below
        // $this->call(ProvinceSeeder::class, false, ["path" => "database/data/1-province.csv", "model" => Province::class]);
        // $this->call(RegencySeeder::class, false, ["path" => "database/data/2-regency.csv", "model" => Regency::class]);
        // $this->call(SchoolSeeder::class, false, ["path" => "database/data/3-school.csv", "model" => School::class]);
        // $this->call(TeacherSeeder::class, false, ["path" => "database/data/4-teacher.csv", "model" => Teacher::class]);

        // $this->call(CompetitionSeeder::class, false, ["path" => "database/data/5-competition.csv", "model" => Competition::class]);
        // $this->call(UserSeeder::class, false, ["path" => "database/data/6-user.csv", "model" => User::class]);
        // $this->call(AdminSeeder::class, false, ["path" => "database/data/7-admin.csv", "model" => Admin::class]);

        // $this->call(TeamSeeder::class, false, ["path" => "database/data/8-team.csv", "model" => Team::class]);
        // $this->call(ParticipantSeeder::class, false, ["path" => "database/data/9-participant.csv", "model" => Participant::class]);
        $this->call(RobotSeeder::class, false, ["path" => "database/data/10-robot.csv", "model" => Robot::class]);
        $this->call(TerritorySeeder::class, false, ["path" => "database/data/11-territory.csv", "model" => Territory::class]);


        // $this->call(EssaySeeder::class);
        // $this->call(McSeeder::class);
        // $this->call(PrgSeeder::class);
    }
}
