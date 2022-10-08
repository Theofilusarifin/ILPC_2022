<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();

            $table->string('tahun', 4);
            $table->longText('tema');
            $table->smallInteger('max_jum_tim');
            $table->enum('status', ['buka', 'tutup']);
            
            $table->bigInteger('biaya_pendaftaran1');
            $table->date('tgl_awal_gelombang1');
            $table->date('tgl_akhir_gelombang1');

            $table->bigInteger('biaya_pendaftaran2');
            $table->date('tgl_awal_gelombang2');
            $table->date('tgl_akhir_gelombang2');

            $table->tinyInteger('poin_benar');
            $table->tinyInteger('poin_salah');
            $table->tinyInteger('poin_kosong');

            // What's this?
            $table->integer('max_poin_ac');
            $table->integer('time_freeze');

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
        Schema::dropIfExists('competitions');
    }
}
