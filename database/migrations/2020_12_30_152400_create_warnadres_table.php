<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarnadresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gez_warnadres', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nummer');
            $table->string('voornaam');
            $table->string('achternaam');
            $table->string('relatie_kind');
            $table->string('adres');
            $table->string('woonplaats');
            $table->string('vast_tel_nummer');
            $table->string('mobiel_tel_nummer');
            $table->foreignId('gez_form_id')->contrained('gez_forms')->delete('cascade');
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
        Schema::dropIfExists('gez_warnadres');
    }
}
