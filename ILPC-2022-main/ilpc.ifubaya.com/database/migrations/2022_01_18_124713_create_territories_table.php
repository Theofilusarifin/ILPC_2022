<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerritoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('territories', function (Blueprint $table) {
            $table->id();
            $table->string('is_spawnable')->nullable();
            $table->string('is_wall')->nullable();

            $table->foreignId('robot_id')->nullable();
            $table->foreign('robot_id')->references('id')->on('robots')->onUpdate('cascade')->onDelete('cascade');

            $table->float('current_health')->nullable();

            $table->integer('num_occupants')->default(0);
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
        Schema::dropIfExists('territories');
    }
}
