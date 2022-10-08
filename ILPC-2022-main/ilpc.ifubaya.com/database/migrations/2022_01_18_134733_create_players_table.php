<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            // Default stats awal pemain
            $table->float('max_health')->default(500);
            $table->float('max_attack')->default(100);
            $table->float('current_health')->default(500);

            $table->foreignId('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');

            $table->float('current_money')->default(0);
            $table->float('poin_gambes')->default(0);

            $table->foreignId('territory_id')->nullable();
            $table->foreign('territory_id')->references('id')->on('territories')->onUpdate('cascade')->onDelete('cascade');

            $table->string('have_shield')->default('no');
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
        Schema::dropIfExists('players');
    }
}
