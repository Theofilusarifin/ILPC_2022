<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_submissions', function (Blueprint $table) {
            $table->foreignId('mc_question_id');
            $table->foreign('mc_question_id')->references('id')->on('mc_questions')->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
            
            $table->text('jawaban');
            $table->text('keyakinan');
            $table->text('skor');

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
        Schema::dropIfExists('mc_submissions');
    }
}
