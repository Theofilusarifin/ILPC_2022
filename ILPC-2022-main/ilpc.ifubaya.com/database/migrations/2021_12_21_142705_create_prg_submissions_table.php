<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrgSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prg_submissions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu_submit')->useCurrent();
            $table->integer('penalti')->default(0);
            $table->string('bahasa');
            $table->string('filename');
            $table->string('runtime');
            $table->string('status');

            $table->foreignId('prg_question_id');
            $table->foreign('prg_question_id')->references('id')->on('prg_questions')->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('prg_submissions');
    }
}
