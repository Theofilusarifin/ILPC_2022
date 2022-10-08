<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('nama', 50);
            $table->string('nis', 20)->nullable();
            $table->string('kartu_pelajar', 100);
            $table->string('kelas', 10);

            $table->string('telp_peserta', 20);
            $table->string('email', 100);
            $table->string('alamat', 100)->nullable();

            $table->string('status');
            $table->string('ukuran_baju', 10)->nullable();
            $table->string('alergi', 150)->nullable();
            $table->enum('vegetarian', ['YA', 'TIDAK'])->nullable();

            $table->foreignId('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
