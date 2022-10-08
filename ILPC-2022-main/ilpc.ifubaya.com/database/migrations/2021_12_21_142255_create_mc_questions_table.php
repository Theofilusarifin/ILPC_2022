<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->text('isi');
            $table->string('jawaban_benar');
            $table->foreignId('mc_contest_id');
            $table->foreign('mc_contest_id')->references('id')->on('mc_contests')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('mc_questions');
    }
}
