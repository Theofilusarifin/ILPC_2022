<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrgQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prg_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->string('judul');
            $table->text('isi');
            $table->string('input')->nullable();
            $table->string('output')->nullable();
            $table->float('time_limit');
            $table->foreignId('prg_contest_id');
            $table->foreign('prg_contest_id')->references('id')->on('prg_contests')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('prg_questions');
    }
}
