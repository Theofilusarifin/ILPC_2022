<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrgContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prg_contests', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamp('jadwal_mulai')->nullable();
            $table->timestamp('jadwal_selesai')->nullable();
            $table->foreignId('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->integer('scoreboard_freeze');
            $table->string('scoreboard_status');
            $table->string('scoreboard_slug');

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
        Schema::dropIfExists('prg_contests');
    }
}
