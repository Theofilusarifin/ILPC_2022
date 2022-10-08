<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamJoinEssayContestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_join_essay_contest', function (Blueprint $table) {
            $table->foreignId('essay_contest_id');
            $table->foreign('essay_contest_id')->references('id')->on('essay_contests')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('waktu_bergabung')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->float('total_skor')->default(0);
            $table->string('submission_filename')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_join_essay_contest');
    }
}
